<?php

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Pages\ViewCategory;
use App\Models\Category;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
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

test('can bulk delete users', function () {
    $categories = Category::factory()->count(5)->create();

    Livewire::test(ListCategories::class)
        ->assertCanSeeTableRecords($categories)
        ->selectTableRecords($categories)
        ->callAction(TestAction::make(DeleteBulkAction::class)->table()->bulk())
        ->assertNotified()
        ->assertCanNotSeeTableRecords($categories);

    $categories->each(function ($category) {
            $this->assertDatabaseMissing($category);
        });;
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
    $category = Category::factory()->create([
        'icon' => UploadedFile::fake()->image('poster.jpg')
    ]);

    Livewire::test(EditCategory::class, ['record' => $category->slug])
        ->assertOk()
        ->assertSchemaStateSet([
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            // 'icon' => $category->icon,
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

test('can delete category', function(){
    $category = Category::factory()->create();

    Livewire::test(EditCategory::class, ['record' => $category->slug])
        ->callAction(DeleteAction::class)
        ->assertNotified()
        ->assertRedirect();

        $this->assertDatabaseMissing($category);
});

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
