@extends('layouts.app')

@section('content')
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/70 backdrop-blur-md border border-white/50 rounded-[2.5rem] shadow-xl p-8 md:p-12">
            
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    New <span class="text-emerald-600">Category</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium">Tambah klasifikasi baru untuk kegiatan PC DESBOR</p>
                <div class="h-1 w-20 bg-emerald-500 rounded-full mt-4 mx-auto md:mx-0"></div>
            </div>

            @if ($errors->any())
                <div class="mb-8 bg-rose-50 border border-rose-100 text-rose-700 p-6 rounded-2xl">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm uppercase tracking-wider">Perhatian:</span>
                    </div>
                    <ul class="list-disc pl-5 text-xs font-semibold leading-relaxed">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Category Name</label>
                    <div class="relative">
                        <input type="text" name="nama" value="{{ old('nama') }}" 
                               class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all placeholder:text-slate-300 uppercase tracking-tight" 
                               placeholder="Contoh: PELATIHAN TEKNIS" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[11px] font-black text-slate-400 uppercase tracking-[0.15em] ml-1">Short Description</label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full bg-slate-100/50 border-none rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500 transition-all placeholder:text-slate-300 leading-relaxed" 
                              placeholder="Gambarkan kategori ini secara singkat...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-6 pt-4">
                    <button type="submit" class="w-full md:w-auto bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 px-12 rounded-2xl text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-200 hover:-translate-y-1">
                        Confirm & Save
                    </button>
                    
                    <a href="{{ route('admin.kategori.index') }}" class="group flex items-center gap-2 text-[11px] font-black uppercase text-slate-400 hover:text-rose-600 tracking-widest transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection