@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-2 border-gray-900 shadow-[10px_10px_0px_0px_rgba(0,0,0,1)] p-8">
            <h1 class="text-3xl font-black text-gray-900 uppercase italic tracking-tighter mb-8 border-b-2 border-gray-900 pb-2">
                New <span class="text-green-600">Category</span>
            </h1>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-600 text-red-700 p-4 font-bold text-xs uppercase tracking-tight">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Category Name</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" 
                           class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" 
                           placeholder="EX: PELATIHAN TEKNIS" required>
                </div>

                <div class="mb-8">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Short Description</label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full border-2 border-gray-900 p-3 text-sm font-bold focus:ring-0 focus:border-green-600 transition-colors shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]" 
                              placeholder="Describe this category briefly...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-4">
                    <button type="submit" class="w-full md:w-auto bg-green-600 hover:bg-black text-white font-black py-3 px-10 uppercase tracking-widest text-xs transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,0.1)]">
                        Confirm & Save
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="text-[10px] font-black uppercase text-gray-400 hover:text-red-600 tracking-widest">
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection