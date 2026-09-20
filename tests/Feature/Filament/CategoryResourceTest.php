<?php

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Pages\ViewCategory;
use App\Models\Category;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\Testing\TestAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Livewire\Livewire;

beforeEach(function(){
    $this->actingAs(User::factory()->super_admin()->create());
});

// Testing Resource List Page
test('can load list categories page ', function(){

    $categories = Category::factory(5)->create();
    Livewire::test(ListCategories::class)
        ->assertOk()
        ->assertCanSeeTableRecords($categories);
});

test('can render all category colums', function(){
    Livewire::test(ListCategories::class)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('icon')
        ->assertCanRenderTableColumn('status');
});


test('can search category by name ', function(){

        $categories = Category::factory(5)->create();

        Livewire::test(ListCategories::class)
            ->assertOk()
            ->assertCanSeeTableRecords($categories)
            ->searchTable($categories->first()->name)
            ->assertCanSeeTableRecords($categories->take(1))
            ->searchTable($categories->last()->name)
            ->assertCanSeeTableRecords($categories->take(-1));
});

test('can sort category by name', function(){

    $categories = Category::factory(5)->create();

        Livewire::test(ListCategories::class)
            ->assertOk()
            ->assertCanSeeTableRecords($categories)
            ->sortTable('name')
            ->assertCanSeeTableRecords($categories->sortBy('name'), inOrder: true)
            ->sortTable('name', 'desc')
            ->assertCanSeeTableRecords($categories->sortByDesc('name'), inOrder: true);
});


test('shows the toggled hidden columns', function () {
    Livewire::test(ListCategories::class)
        ->assertTableColumnVisible('created_at')
        ->assertTableColumnVisible('updated_at');
});

// Test Resource Create Category
test('can load create category page', function(){
    Livewire::test(CreateCategory::class)
        ->assertOK();
});

test('has a form', function(){
    Livewire::test(CreateCategory::class)
        ->assertSchemaExists('form');
});

test('has all category fields', function(){
    Livewire::test(CreateCategory::class)
        ->assertFormFieldExists('name')
        ->assertFormFieldExists('slug')
        ->assertFormFieldExists('icon')
        ->assertFormFieldExists('description')
        ->assertFormFieldExists('status');
});

test('can create category', function(){
    $category = Category::factory()->make();
    $fakeIcon = UploadedFile::fake()->image('poster.jpg');

    Livewire::test(CreateCategory::class)
            ->assertOk()
            ->fillForm([
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
                'icon' => $fakeIcon,
                'status' => $category->status

            ])
            ->call('create')
            ->assertNotified()
            ->assertRedirect();

    $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'status' => $category->status
    ]);
});

test('validates form data create category', function(array $data, array $errors){

    $category = Category::factory()->make();
    $fakeIcon = UploadedFile::fake()->image('poster.jpg');

    Livewire::test(CreateCategory::class)
        ->fillForm([
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'icon' => $fakeIcon,
            'status' => $category->status,
            ...$data,
        ])
        ->call('create')
        ->assertHasFormErrors($errors)
        ->assertNotNotified()
        ->assertNoRedirect();
})
->with([
    '`name` is required' => [
        ['name' => null],
        ['name' => 'required'],
    ],
    '`name` is max 100 characters' => [
        ['name' => Str::random(101)],
        ['name' => 'max'],
    ],
    '`status` is required' => [
        ['status' => null],
        ['status' => 'required'],
    ],
    '`icon` is required' => [
        ['icon' => null],
        ['icon' => 'required'],
    ]
]);

// Tet Resource Edit Category
test('can load edit category page', function(){
    $category = Category::factory()->create();

    Livewire::test(EditCategory::class, ['record' => $category->slug])
        ->assertOk()
        ->assertSchemaStateSet([
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'status' => $category->status
        ]);
});

test('can update category', function(){

    $category = Category::factory()->create();
    $newCategory = Category::factory()->make();
    $fakeIcon = UploadedFile::fake()->image('icon.png');

    Livewire::test(EditCategory::class, ['record' => $category->slug])
        ->assertOk()
            ->fillForm([
                'name' => $newCategory->name,
                'slug' => $newCategory->slug,
                'description' => $newCategory->description,
                'icon' => $fakeIcon,
                'status' => $newCategory->status
            ])
            ->call('save')
            ->assertNotified()
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('categories', [
            'name' => $newCategory->name,
            'slug' => $newCategory->slug
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => $category->name,
            'slug' => $category->slug
        ]);
});

test('validates form data edit category', function(array $data, array $errors){

    $category = Category::factory()->create();
    $newCategory = Category::factory()->make();
    $fakeIcon = UploadedFile::fake()->image('icon.png');

    Livewire::test(EditCategory::class, ['record' => $category->slug])
        ->assertOk()
            ->fillForm([
                'name' => $newCategory->name,
                'slug' => $newCategory->slug,
                'description' => $newCategory->description,
                'icon' => $fakeIcon,
                'status' => $newCategory->status,
                ...$data
            ])
            ->call('save')
            ->assertHasFormErrors($errors)
            ->assertNotNotified()
            ->assertNoRedirect();

        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'slug' => $category->slug
        ]);
})
->with([
    '`name` is required' => [
        ['name' => null],
        ['name' => 'required'],
    ],
    '`name` is max 100 characters' => [
        ['name' => Str::random(101)],
        ['name' => 'max'],
    ],
    '`status` is required' => [
        ['status' => null],
        ['status' => 'required'],
    ],
    '`icon` is required' => [
        ['icon' => null],
        ['icon' => 'required'],
    ]
]);

// Test Resource Delete Category
test('can soft delete category', function () {
    $category = Category::factory()->create();

    Livewire::test(EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->callAction(DeleteAction::class)
        ->assertNotified()
        ->assertRedirect();

    $this->assertSoftDeleted('categories', [
        'id' => $category->id,
    ]);
});

test('can force delete category permanently', function () {
    // 1. Buat data yang sudah di-soft delete
    $category = Category::factory()->create();
    $category->delete();

    // 2. Panggil ForceDeleteAction di halaman Edit
    Livewire::test(EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->callAction(ForceDeleteAction::class)
        ->assertNotified()
        ->assertRedirect();

    // 3. Pastikan data benar-benar hilang/terhapus dari database
    $this->assertModelMissing($category);
});

test('can restore soft deleted category', function () {
    // 1. Buat data yang sudah di-soft delete
    $category = Category::factory()->create();
    $category->delete();

    // 2. Panggil RestoreAction di halaman Edit
    Livewire::test(EditCategory::class, [
        'record' => $category->getRouteKey(),
    ])
        ->callAction(RestoreAction::class)
        ->assertNotified();

    // 3. Pastikan kolom deleted_at kembali NULL
    $this->assertNotSoftDeleted('categories', [
        'id' => $category->id,
    ]);
});

//  Test Bulk Delete and Restore Categories
test('can bulk soft delete categories', function () {
    $categories = Category::factory()->count(5)->create();

    Livewire::test(ListCategories::class)
        ->assertCanSeeTableRecords($categories)
        ->callTableBulkAction(DeleteBulkAction::class, $categories)
        ->assertNotified()
        ->assertCanNotSeeTableRecords($categories);

    $categories->each(function ($category) {
        $this->assertSoftDeleted('categories', [
            'id' => $category->id,
        ]);
    });
});

// test('can bulk force delete categories permanently', function () {
//     // 1. Buat 5 data yang di-soft delete
//     $categories = Category::factory()->count(5)->create();
//     $categories->each->delete();

//     // 2. Jalankan Bulk Force Delete Action
//     Livewire::test(ListCategories::class)
//         ->callTableBulkAction(ForceDeleteBulkAction::class, $categories)
//         ->assertNotified();

//     // 3. Pastikan semua data benar-benar terhapus dari database
//     $categories->each(function ($category) {
//         $this->assertModelMissing($category);
//     });
// });

// test('can bulk restore soft deleted categories', function () {
//     $categories = Category::factory()->count(5)->create();
//     $categories->each->delete();

//     Livewire::test(ListCategories::class)
//         ->callAction(TestAction::make(RestoreBulkAction::class)->table()->bulk())
//         ->assertNotified();

//     $categories->each(function ($category) {
//         $this->assertNotSoftDeleted('categories', [
//             'id' => $category->id,
//         ]);
//     });
// });

// Test Resource View Category
test('can load view category page', function(){
    $category = Category::factory()->create();

    Livewire::test(ViewCategory::class, ['record' => $category->slug])
        ->assertOk()
        ->assertSchemaStateSet([
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            // 'icon' => $category->icon,
            'status' => $category->status
        ]);
});
