@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border-4 border-gray-900 shadow-[15px_15px_0px_0px_rgba(21,128,61,1)] overflow-hidden">
            <div class="bg-green-700 px-8 py-6 border-b-4 border-gray-900">
                <h1 class="text-2xl font-black text-white uppercase italic tracking-tighter">Bulk <span class="text-yellow-400">Upload</span></h1>
                <p class="text-[10px] text-green-100 font-bold uppercase tracking-widest italic mt-1">Kegiatan: {{ $kegiatan->judul }}</p>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.galeri.store', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-10 p-6 bg-gray-50 border-2 border-dashed border-gray-300 relative group transition-all hover:border-green-600">
                        <label class="block text-center cursor-pointer">
                            <span class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4">Pilih Foto (Multiple Allowed)</span>
                            <input type="file" id="fotos" name="fotos[]" accept="image/*" multiple required 
                                   class="block w-full text-xs font-bold text-gray-500 file:mr-4 file:py-3 file:px-8 file:border-2 file:border-gray-900 file:bg-yellow-400 file:text-gray-900 hover:file:bg-black hover:file:text-white file:cursor-pointer file:uppercase file:font-black">
                        </label>
                    </div>

                    <div id="dynamic-container" class="space-y-6">
                        <div class="text-center py-10 border-2 border-gray-100">
                            <p class="text-gray-400 font-bold text-[10px] uppercase italic tracking-widest">Input judul foto akan muncul di sini setelah file dipilih</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-12 pt-8 border-t-4 border-gray-100">
                        <a href="{{ route('admin.galeri.show', $kegiatan->id_kegiatan) }}" class="text-[10px] font-black uppercase text-gray-400 hover:text-red-600 tracking-widest">
                            ← Batal
                        </a>
                        <button type="submit" class="bg-gray-900 hover:bg-green-700 text-white font-black py-4 px-12 uppercase tracking-[0.2em] text-[11px] shadow-[6px_6px_0px_0px_rgba(234,179,8,1)] transition-all active:translate-y-1">
                            Mulai Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Script biar input judul muncul otomatis sesuai jumlah file
    document.getElementById('fotos').addEventListener('change', function(e) {
        const container = document.getElementById('dynamic-container');
        container.innerHTML = '';
        
        const files = e.target.files;
        if (files.length > 0) {
            container.innerHTML = '<h3 class="text-[10px] font-black uppercase tracking-widest text-green-700 mb-4 italic underline">Detail File Terpilih:</h3>';
            
            for (let i = 0; i < files.length; i++) {
                const row = document.createElement('div');
                row.className = 'grid grid-cols-1 md:grid-cols-3 gap-4 items-center p-4 bg-white border-2 border-gray-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,0.05)]';
                row.innerHTML = `
                    <div class="text-[10px] font-black truncate text-gray-500">${files[i].name}</div>
                    <input type="text" name="judul[]" placeholder="JUDUL FOTO ${i+1}" class="border-2 border-gray-900 p-2 text-[10px] font-black uppercase focus:ring-0 focus:border-green-600">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="unggulan[]" value="${i}" class="w-4 h-4 border-2 border-gray-900 text-green-600 focus:ring-0">
                        <span class="text-[9px] font-black uppercase tracking-tighter">Set Sebagai Unggulan</span>
                    </label>
                `;
                container.appendChild(row);
            }
        }
    });
</script>
@endsection