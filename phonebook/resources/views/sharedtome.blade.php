<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts shared to you') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($contacts) == 0)
                        <div>Nobody shared contacts with you.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-sm table-success ">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Who shared</th>
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
                                        <td>{{ $contact->name }}</td>
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>

                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
