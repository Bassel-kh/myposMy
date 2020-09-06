<form x-data="laratrustForm()" x-init="" method="POST" action="http://127.0.0.1:8000/laratrust/permissions/3" class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 p-8">
    <input type="hidden" name="_token" value="V2jA9idPscK81C0IuOUUmkQh69aVyA9HcgT1BaGq">                  <input type="hidden" name="_method" value="PUT">                <label class="block">
        <span class="text-gray-700">Name/Code</span>
        <input class="form-input mt-1 block w-full bg-gray-200 text-gray-600 " name="name" placeholder="this-will-be-the-code-name" :value="name" readonly="" autocomplete="off">
    </label>

    <label class="block my-4">
        <span class="text-gray-700">Display Name</span>
        <input class="form-input mt-1 block w-full" name="display_name" placeholder="Edit user profile" x-model="displayName" autocomplete="off">
    </label>

    <label class="block my-4">
        <span class="text-gray-700">Description</span>
        <textarea class="form-textarea mt-1 block w-full" rows="3" name="description" placeholder="Some description for the permission">Update Users</textarea>
    </label>
    <div class="flex justify-end">
        <a href="http://127.0.0.1:8000/laratrust/permissions" class="btn btn-red mr-4">
            Cancel
        </a>
        <button class="btn btn-blue" type="submit">Save</button>
    </div>
</form>
