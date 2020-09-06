<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
    <form x-data="laratrustForm()" x-init="" method="POST" action="http://127.0.0.1:8000/laratrust/roles/1" class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 p-8">
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
            <textarea class="form-textarea mt-1 block w-full" rows="3" name="description" placeholder="Some description for the role">Superadministrator</textarea>
        </label>
        <span class="block text-gray-700">Permissions</span>
        <div class="flex flex-wrap justify-start mb-4">
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="1" checked="">
                <span class="ml-2">Create Users</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="2" checked="">
                <span class="ml-2">Read Users</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="3" checked="">
                <span class="ml-2">Update Users</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="4" checked="">
                <span class="ml-2">Delete Users</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="5" checked="">
                <span class="ml-2">Create Payments</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="6" checked="">
                <span class="ml-2">Read Payments</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="7" checked="">
                <span class="ml-2">Update Payments</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="8" checked="">
                <span class="ml-2">Delete Payments</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="9" checked="">
                <span class="ml-2">Read Profile</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="10" checked="">
                <span class="ml-2">Update Profile</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="11">
                <span class="ml-2">Create Module_1_name</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="12">
                <span class="ml-2">Read Module_1_name</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="13">
                <span class="ml-2">Update Module_1_name</span>
            </label>
            <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="14">
                <span class="ml-2">Delete Module_1_name</span>
            </label>
        </div>
        <div class="flex justify-end">
            <a href="http://127.0.0.1:8000/laratrust/roles" class="btn btn-red mr-4">
                Cancel
            </a>
            <button class="btn btn-blue" type="submit">Save</button>
        </div>
    </form>
</div>
