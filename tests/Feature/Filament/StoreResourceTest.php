<?php

use App\Filament\Resources\Stores\Pages\CreateStore;
use App\Filament\Resources\Stores\Pages\EditStore;
use App\Filament\Resources\Stores\Pages\ListStores;
use App\Filament\Resources\Stores\Pages\ViewStore;
use App\Models\Store;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Livewire\Livewire;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;

beforeEach(function(){
    $this->actingAs(User::factory()->super_admin()->create());
});

// Test Store Resource List
test('can load list store list', function(){
    $stores = Store::factory(10)->create();
    Livewire::test(ListStores::class)
        ->assertOk()
        ->assertCanSeeTableRecords($stores);
});

test('can render all store colums', function(){
    Livewire::test(ListStores::class)
        ->assertCanRenderTableColumn('logo')
        ->assertCanRenderTableColumn('user.name')
        ->assertCanRenderTableColumn('is_verified')
        ->assertCanRenderTableColumn('approval_status')
        ->assertCanRenderTableColumn('status');
});


test('can search store by name', function(){

        $stores = Store::factory(10)->create();

        Livewire::test(ListStores::class)
            ->assertOk()
            ->assertCanSeeTableRecords($stores)
            ->searchTable($stores->first()->name)
            ->assertCanSeeTableRecords($stores->take(1))
            ->searchTable($stores->last()->name)
            ->assertCanSeeTableRecords($stores->take(-1));
});

test('can sort store by name', function(){

    $stores = Store::factory(10)->create();

        Livewire::test(ListStores::class)
            ->assertOk()
            ->assertCanSeeTableRecords($stores)
            ->sortTable('name')
            ->assertCanSeeTableRecords($stores->sortBy('name'), inOrder: true)
            ->sortTable('name', 'desc')
            ->assertCanSeeTableRecords($stores->sortByDesc('name'), inOrder: true);
});

test('can bulk delete stores', function () {
    $stores = Store::factory(5)->create();

    Livewire::test(ListStores::class)
        ->assertCanSeeTableRecords($stores)
        ->callTableBulkAction(DeleteBulkAction::class, $stores)
        ->assertNotified()
        ->assertCanNotSeeTableRecords($stores);

    $stores->each(function ($store) {
        $this->assertSoftDeleted('stores', [
            'id' => $store->id,
        ]);
    });
});

test('shows the toggled hidden columns', function () {
    Livewire::test(ListStores::class)
        ->assertTableColumnVisible('ktp_number')
        ->assertTableColumnVisible('ktp_image')
        ->assertTableColumnVisible('created_at')
        ->assertTableColumnVisible('updated_at')
        ->assertTableColumnVisible('deleted_at');
});

// Test Resource Edit Store Page
test('can load edit store page', function(){
    $store = Store::factory()->create();

    Livewire::test(EditStore::class, ['record' => $store->slug])
        ->assertOk()
        ->assertSchemaExists('form')
        ->assertSchemaStateSet([
            'name' => $store->name,
            'slug' => $store->slug,
            'description' => $store->description,
            'status' => $store->status
        ]);
});

test('has all store fields', function(){

    $store = Store::factory()->create();

    Livewire::test(EditStore::class, ['record' => $store->slug])
        ->assertOk()
        ->assertFormFieldExists('name')
        ->assertFormFieldExists('slug')
        ->assertFormFieldExists('description')
        ->assertFormFieldExists('logo')
        ->assertFormFieldExists('banner')
        ->assertFormFieldExists('user_id')
        ->assertFormFieldExists('ktp_number')
        ->assertFormFieldExists('ktp_image')
        ->assertFormFieldExists('approval_status')
        ->assertFormFieldExists('message')
        ->assertFormFieldExists('status')
        ->assertFormFieldExists('is_verified');
});

test('can validate store', function(){

    $store = Store::factory()->create();

    Livewire::test(EditStore::class, ['record' =>$store->slug])
        ->assertOk()
            ->fillForm([
                'approval_status' => 'approved',
                'message' => 'Approved Success',
                'status' => 'active',
                'is_verified' => true,
            ])
            ->call('save')
            ->assertNotified()
            ->assertHasNoFormErrors();

});

test('validates required and maximum length form fields', function ($field, $value, $rule) {
    $store = Store::factory()->create();

    Livewire::test(EditStore::class, [
        'record' => $store->getRouteKey(),
    ])
        ->fillForm([$field => $value])
        ->call('save')
        ->assertHasFormErrors([$field => $rule]);
})->with([
    'name is required' => ['name', '', 'required'],

    // '`name` is max 100 characters' => [
    //     'name',
    //     Str::random(101),
    //     'max',
    // ],

    'slug is required' => ['slug', '', 'required'],

    // '`slug` is max 100 characters' => [
    //     'slug',
    //     Str::random(101),
    //     'max',
    // ],

    // '`ktp_number` is max 16 characters' => [
    //     'ktp_number',
    //     Str::random(101),
    //     'max',
    // ],
]);

test('validates unique slug field', function () {
    $existingStore = Store::factory()->create(['slug' => 'existing-store']);
    $storeToEdit = Store::factory()->create();

    Livewire::test(EditStore::class, [
        'record' => $storeToEdit->getRouteKey(),
    ])
        ->fillForm(['slug' => 'existing-store'])
        ->call('save')
        ->assertHasFormErrors(['slug' => 'unique']);
});

test('can save valid store data successfully', function () {
    $store = Store::factory()->create();

    Livewire::test(EditStore::class, [
        'record' => $store->getRouteKey(),
    ])
        ->fillForm([
            'name' => 'Updated Store Name',
            'slug' => 'updated-store-name',
            'approval_status' => 'approved',
            'status' => 'active',
            'is_verified' => true,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas('stores', [
        'id' => $store->id,
        'name' => 'Updated Store Name',
        'slug' => 'updated-store-name',
        'approval_status' => 'approved',
        'status' => 'active',
        'is_verified' => true,
    ]);
});


/*
|--------------------------------------------------------------------------
| Single Record Actions (EditStore / Page Actions)
|--------------------------------------------------------------------------
*/

test('can soft delete store', function () {
    $store = Store::factory()->create();

    Livewire::test(EditStore::class, [
        'record' => $store->getRouteKey(),
    ])
        ->callAction(DeleteAction::class)
        ->assertNotified()
        ->assertRedirect();

    $this->assertSoftDeleted('stores', [
        'id' => $store->id,
    ]);
});

test('can restore store', function () {
    $store = Store::factory()->create();
    $store->delete();

    Livewire::test(EditStore::class, [
        'record' => $store->getRouteKey(),
    ])
        ->callAction(RestoreAction::class)
        ->assertNotified();

    $this->assertNotSoftDeleted('stores', [
        'id' => $store->id,
    ]);
});

test('can force delete store', function () {
    $store = Store::factory()->create();
    $store->delete();

    Livewire::test(EditStore::class, [
        'record' => $store->getRouteKey(),
    ])
        ->callAction(ForceDeleteAction::class)
        ->assertNotified()
        ->assertRedirect();

    $this->assertModelMissing($store);
});

/*
|--------------------------------------------------------------------------
| Bulk Actions (ListStores / Table Actions)
|--------------------------------------------------------------------------
*/

test('can bulk soft delete stores', function () {
    $stores = Store::factory()->count(5)->create();

    Livewire::test(ListStores::class)
        ->assertCanSeeTableRecords($stores)
        ->callTableBulkAction(DeleteBulkAction::class, $stores)
        ->assertNotified()
        ->assertCanNotSeeTableRecords($stores);

    $stores->each(function ($store) {
        $this->assertSoftDeleted('stores', [
            'id' => $store->id,
        ]);
    });
});

// test('can bulk restore delete stores', function () {
//     $stores = Store::factory()->count(5)->create();
//     $stores->each->delete();

//     Livewire::test(ListStores::class)
//         ->callTableBulkAction(RestoreBulkAction::class, $stores)
//         ->assertNotified();

//     $stores->each(function ($store) {
//         $this->assertNotSoftDeleted('stores', [
//             'id' => $store->id,
//         ]);
//     });
// });

// test('can bulk force delete stores', function () {
//     $stores = Store::factory()->count(5)->create();
//     $stores->each->delete();

//     Livewire::test(ListStores::class)
//         ->callTableBulkAction(ForceDeleteBulkAction::class, $stores)
//         ->assertNotified();

//     $stores->each(function ($store) {
//         $this->assertModelMissing($store);
//     });
// });

// Test Resource View Category
test('can load view category page', function(){
    $store = Store::factory()->create();

    Livewire::test(ViewStore::class, ['record' => $store->slug])
        ->assertOk()
        ->assertSchemaStateSet([
            'name' => $store->name,
            'slug' => $store->slug,
            'description' => $store->description,
            'status' => $store->status
        ]);
});
