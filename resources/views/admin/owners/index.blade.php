<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{--            {{ __('Dashboard') }}--}}
            オーナー一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">

                        <section class="text-gray-600 body-font">
                            <div class="container md:px-5 mx-auto">
                                <x-flash-message status="session('status')" />
                                <div class="flex justify-end mb-4">
                                    <button onclick="location.href='{{ route('admin.owners.create') }}'" class="text-black bg-indigo-500 !important border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded text-lg">新規登録する</button>
                                </div>
                                    {{--                                <div class="flex flex-col text-center w-full mb-20">--}}
{{--                                    <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Pricing</h1>--}}
{{--                                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Banh mi cornhole echo park skateboard authentic crucifix neutra tilde lyft biodiesel artisan direct trade mumblecore 3 wolf moon twee</p>--}}
{{--                                </div>--}}
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                                <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                                <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
{{--                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Price</th>--}}
                                                <th class="md:w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                                <th class="md:w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($owners as $owner)
                                        <tr>
                                            <td class="md:px-4 py-3">{{ $owner->name  }}</td>
                                            <td class="md:px-4 py-3">{{ $owner->email  }}</td>
                                            <td class="md:px-4 py-3">{{ $owner->created_at->diffForHumans()  }}</td>
{{--                                            <td class="px-4 py-3 text-lg text-gray-900">Free</td>--}}
                                            <td class="md:w-10 text-center">
                                                <button onclick="location.href='{{ route('admin.owners.edit', ['owner' => $owner->id]) }}'" class="flex mx-auto text-black bg-indigo-500 !important border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded">編集する</button>
{{--                                                <input name="plan" type="radio">--}}
                                            </td>
                                            <form id="delete_{{$owner->id}}" method="post" action="{{ route('admin.owners.destroy', ['owner' => $owner->id]) }}">
                                                @method('delete')
                                                @csrf
                                                <td class="md:w-10 text-center">
                                                    <a href="#" data-id="{{ $owner->id }}" onclick="deletePost(this)" class="flex mx-auto text-black bg-indigo-500 !important border-0 py-2 px-8 focus:outline-none hover:bg-yellow-600 rounded">削除</a>
                                                    {{--                                                <input name="plan" type="radio">--}}
                                                </td>
                                            </form>
                                        </tr>
                                        @endforeach
{{--                                        <tr>--}}
{{--                                            <td class="border-t-2 border-gray-200 px-4 py-3">Pro</td>--}}
{{--                                            <td class="border-t-2 border-gray-200 px-4 py-3">25 Mb/s</td>--}}
{{--                                            <td class="border-t-2 border-gray-200 px-4 py-3">25 GB</td>--}}
{{--                                            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$24</td>--}}
{{--                                            <td class="border-t-2 border-gray-200 w-10 text-center">--}}
{{--                                                <input name="plan" type="radio">--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td class="border-t-2 border-gray-200 px-4 py-3">Business</td>--}}
{{--                                            <td class="border-t-2 border-gray-200 px-4 py-3">36 Mb/s</td>--}}
{{--                                            <td class="border-t-2 border-gray-200 px-4 py-3">40 GB</td>--}}
{{--                                            <td class="border-t-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$50</td>--}}
{{--                                            <td class="border-t-2 border-gray-200 w-10 text-center">--}}
{{--                                                <input name="plan" type="radio">--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">Exclusive</td>--}}
{{--                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">48 Mb/s</td>--}}
{{--                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">120 GB</td>--}}
{{--                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-lg text-gray-900">$72</td>--}}
{{--                                            <td class="border-t-2 border-b-2 border-gray-200 w-10 text-center">--}}
{{--                                                <input name="plan" type="radio">--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
                                        </tbody>
                                    </table>
                                    {{ $owners->links() }}
                                </div>
{{--                                <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">--}}
{{--                                    <a class="text-yellow-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More--}}
{{--                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">--}}
{{--                                            <path d="M5 12h14M12 5l7 7-7 7"></path>--}}
{{--                                        </svg>--}}
{{--                                    </a>--}}
{{--                                    <button class="flex ml-auto text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded">Button</button>--}}
{{--                                </div>--}}
                            </div>
                        </section>

{{--                    エロクアント--}}
{{--                    @foreach($e_all as $e_owner)--}}
{{--                        {{ $e_owner->name  }}--}}
{{--                        {{ $e_owner->created_at->diffForHumans()  }}--}}
{{--                    @endforeach--}}
{{--                    <br>--}}
{{--                    クエリビルダ--}}
{{--                    @foreach($q_get as $q_owner)--}}
{{--                        {{ $q_owner->name  }}--}}
{{--                        {{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }}--}}
{{--                    @endforeach--}}
                </div>
            </div>
        </div>
    </div>
<script>
    function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもいいですか？')) {
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
</script>
</x-app-layout>
