<div class="px-4 py-6 sm:px-0 tab-pane" id="Roles">
    <div class="flex flex-col">
        <a href="http://127.0.0.1:8000/laratrust/roles/create" class="self-end bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            + New Role
        </a>
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                    <tr>
                        <th class="th">Id</th>
                        <th class="th">Display Name</th>
                        <th class="th">Name</th>
                        <th class="th"># Permissions</th>
                        <th class="th"></th>
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
                            superadministrator
                        </td>
                        <td class="td text-sm leading-5 text-gray-900">
                            10
                        </td>
                        <td class="flex justify-end px-6 py-4 whitespace-no-wrap  border-b border-gray-200 text-sm leading-5 font-medium">
                            <a href="http://127.0.0.1:8000/laratrust/roles/1/edit" class="text-blue-600 hover:text-blue-900 p-1">Edit</a>
                            <form action="http://127.0.0.1:8000/laratrust/roles/1" method="POST" onsubmit="return confirm('Are you sure you want to delete the record?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="jmAbLdylkjzAVqWyi8OuJYKaB7Rm4iO5A6mbaC0t">
                                <button type="submit" class="text-red-600 hover:text-red-900 p-1 ">Delete</button>
                            </form>
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
                            administrator
                        </td>
                        <td class="td text-sm leading-5 text-gray-900">
                            6
                        </td>
                        <td class="flex justify-end px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                            <a href="http://127.0.0.1:8000/laratrust/roles/2/edit" class="text-blue-600 hover:text-blue-900 p-1">Edit</a>
                            <form action="http://127.0.0.1:8000/laratrust/roles/2" method="POST" onsubmit="return confirm('Are you sure you want to delete the record?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="jmAbLdylkjzAVqWyi8OuJYKaB7Rm4iO5A6mbaC0t">
                                <button type="submit" class="text-red-600 hover:text-red-900 p-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
