<form method="POST" action="http://127.0.0.1:8000/laratrust/roles-assignment/3?model=users" class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 p-8">
    <input type="hidden" name="_token" value="V2jA9idPscK81C0IuOUUmkQh69aVyA9HcgT1BaGq">        <input type="hidden" name="_method" value="PUT">        <label class="block">
        <span class="text-gray-700">Name</span>
        <input class="form-input mt-1 block w-full bg-gray-200 text-gray-600" name="name" placeholder="this-will-be-the-code-name" value="User" readonly="" autocomplete="off">
    </label>
    <span class="block text-gray-700 mt-4">Roles</span>
    <div class="flex flex-wrap justify-start mb-4">
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="roles[]" value="1">
            <span class="ml-2 ">
                Superadministrator
              </span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="roles[]" value="2">
            <span class="ml-2 ">
                Administrator
              </span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="roles[]" value="3" checked="">
            <span class="ml-2 ">
                User
              </span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="roles[]" value="4">
            <span class="ml-2 ">
                Role Name
              </span>
        </label>
    </div>
    <span class="block text-gray-700 mt-4">Permissions</span>
    <div class="flex flex-wrap justify-start mb-4">
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="1">
            <span class="ml-2">Create Users</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="2">
            <span class="ml-2">Read Users</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="3">
            <span class="ml-2">Update Users</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="4">
            <span class="ml-2">Delete Users</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="5">
            <span class="ml-2">Create Payments</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="6">
            <span class="ml-2">Read Payments</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="7">
            <span class="ml-2">Update Payments</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="8">
            <span class="ml-2">Delete Payments</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="9">
            <span class="ml-2">Read Profile</span>
        </label>
        <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
            <input type="checkbox" class="form-checkbox h-4 w-4" name="permissions[]" value="10">
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
        <a href="http://127.0.0.1:8000/laratrust/roles-assignment?model=users" class="btn btn-red mr-4">
            Cancel
        </a>
        <button class="btn btn-blue" type="submit">Save</button>
    </div>
</form>
