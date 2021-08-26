<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Phone book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#newContactModal">
                        Add new contact
                    </button>
                    @if (count($contacts) == 0)
                        <div>Your phone book is empty... You can add new contact by pressing button above</div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm table-success ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone number</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                            <x-success-message/>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $contact->contact_name }}</td>
                                        <td>{{ $contact->contact_phone_number }}</td>
                                        <td>
                                            <div class="imageRow">
                                                <div class="imageColumn"><a href="#" data-id="{{$contact->id}}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#shareContactModal"><img
                                                            src="/images/share.png" alt="Share" width="15"
                                                            height="15"></a></div>

                                                <div class="imageColumn"><a href="#" data-id="{{$contact->id}}"
                                                                            data-name="{{ $contact->contact_name }}"
                                                                            data-number="{{ $contact->contact_phone_number }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editContactModal"><img
                                                            src="/images/edit.png" alt="Edit" width="15"
                                                            height="15"></a></div>

                                                <div class="imageColumn">

                                                    <a href="{{"/stop/".$contact->id}}"><img src="/images/delete.png"
                                                                                               alt="Delete"
                                                                                               width="15"
                                                                                               height="15"></a>


                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    </div>

                    <!-- Add contact Modal -->
                    <div class="modal fade" id="newContactModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">New contact</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/dashboard') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="addInputEmail1" class="form-label">Name</label>
                                            <input type="text" name="contact_name" class="form-control" id="exampleInputEmail1"
                                                   aria-describedby="emailHelp" maxlength="70">

                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Phone number</label>
                                            <input type="text" name="contact_phone_number" class="form-control"
                                                   id="exampleInputPassword1" maxlength="30">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Create contact</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Edit contact Modal -->
                    <div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit contact</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ url('/update')}}" method="POST" id="update">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" id="contactID">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <input type="text" name="contact_name" id="editName" class="form-control"
                                                   aria-describedby="emailHelp" maxlength="70">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Phone number</label>
                                            <input type="text" name="contact_phone_number" id="editPhoneNumber"
                                                   class="form-control" maxlength="30">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- Share contact Modal -->
                    <div class="modal fade" id="shareContactModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Share contact</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('/share') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" id="contactID">
                                        <div class="mb-3">
                                            <label for="addInputEmail1" class="form-label">Share with user (Choose or write other user email)</label>
                                            <input list="users" name="email" class="form-control"
                                                   id="exampleInputEmail1"
                                                   aria-describedby="emailHelp">
                                            <datalist id="users">
                                                @foreach($users as $user)
                                                    <option name="sharedTo" value="{{ $user->email }}">
                                                @endforeach
                                            </datalist>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Share contact</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}" defer></script>

</x-app-layout>
