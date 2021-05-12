<div class="p-6 w-60  bg-gray-900 h-screen"   x-show="sidebar"  @click.away="sidebar = false" role="menu"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90">
                    
                    <div class="divide-y ">
                        
                        <div class="flex-1 flex items-center justify-center sm:items-stretch mb-4">
                            <div class="flex-shrink-0 flex items-center">
                                <img class="block lg:hidden h-6 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                                <img class="hidden lg:block h-6 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">
                            </div>
                            
                            </div>
                            <div class="mb-4"></div>
                        
                    </div>
                    <div class="">
                    <h6 class="font-bold mb-2 text-white">Acciones Rapidas</h6>
                        <ul>
                            <a type="button" class="p-4 text-white rounded-md hover:bg-gray-800 w-full cursor-pointer" href="{{ route('dashboard')}}"><i class="fas fa-home"></i> Inicio</a>
                            @role('Administrador')
                            <a type="button" class="p-4 text-white rounded-md hover:bg-gray-800 w-full cursor-pointer" href="{{ route('admin.users.index')}}"><i class="fas fa-users"></i> Usuarios</a>
                            @endrole
                        </ul>
                    <h6 class="font-bold mb-2 text-white">Configuracion</h6>
                        <ul>
                            <li class="p-4 text-white rounded-md hover:bg-gray-800 cursor-pointer"><i class="fas fa-user"></i> Perfil</li>
                            <li class="p-4 text-white rounded-md hover:bg-gray-800 cursor-pointer"><i class="fas fa-tools"></i> Ajustes</li>
                            
                        </ul>
                    </div>
</div>