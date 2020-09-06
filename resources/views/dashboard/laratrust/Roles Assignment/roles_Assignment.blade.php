<div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 tab-pane active" id="Roles_Permissions_Assignment">
    <div x-data="{ model:  'users'  }" x-init="$watch('model', value => value != 'initial' ? window.location = `?model=${value}` : '')" class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 p-4">
        <span class="text-gray-700">User model to assign roles/permissions</span>
        <label class="block w-3/12">
            <select class="form-select block w-full mt-1" x-model="model">
                <option value="initial" disabled="" selected="">Select a user model</option>
                <option value="users">Users</option>
                <option value="admins">Admins</option>
                <option value="customers">Customers</option>
            </select>
        </label>
        <div class="flex mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg ">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="th">Id</th>
                    <th class="th">Name</th>
                    <th class="th"># Roles</th>
                    <th class="th"># Permissions</th>                <th class="th"></th>
                </tr>
                </thead>
                <tbody class="bg-white">
                <tr>
                    <td class="td text-sm leading-5 text-gray-900">
                        1
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        Superadministrator
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        1
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        0
                    </td>
                    <td class="flex justify-end px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                        <a href="http://127.0.0.1:8000/laratrust/roles-assignment/1/edit?model=users" class="text-blue-600 hover:text-blue-900">Edit</a>
                    </td>
                </tr>
                <tr>
                    <td class="td text-sm leading-5 text-gray-900">
                        2
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        Administrator
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        1
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        0
                    </td>
                    <td class="flex justify-end px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                        <a href="http://127.0.0.1:8000/laratrust/roles-assignment/2/edit?model=users" class="text-blue-600 hover:text-blue-900">Edit</a>
                    </td>
                </tr>
                <tr>
                    <td class="td text-sm leading-5 text-gray-900">
                        3
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        User
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        1
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        0
                    </td>
                    <td class="flex justify-end px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                        <a href="http://127.0.0.1:8000/laratrust/roles-assignment/3/edit?model=users" class="text-blue-600 hover:text-blue-900">Edit</a>
                    </td>
                </tr>
                <tr>
                    <td class="td text-sm leading-5 text-gray-900">
                        4
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        Role Name
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        1
                    </td>
                    <td class="td text-sm leading-5 text-gray-900">
                        0
                    </td>
                    <td class="flex justify-end px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                        <a href="http://127.0.0.1:8000/laratrust/roles-assignment/4/edit?model=users" class="text-blue-600 hover:text-blue-900">Edit</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 sm:flex sm:items-center sm:justify-end">
                <div>
      <span class="relative z-0 inline-flex shadow-sm">
            @if(app()->getLocale() == 'ar')
              <span class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">


                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                      Previous
            </span>

              <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                    Next
                      <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>

                  </span>
          @else
              <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">


                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              Previous
            </span>
              <span class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                Next
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </span>
          @endif
      </span>
                </div>
            </div>
        </div>

    </div>
</div>
