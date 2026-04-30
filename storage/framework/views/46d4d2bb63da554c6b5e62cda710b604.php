

<?php $__env->startSection('content'); ?>
<div class="pt-28 pb-12 bg-slate-50 min-h-screen font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div class="flex items-center gap-4">
                <div class="bg-emerald-600 p-3 rounded-2xl shadow-lg shadow-emerald-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight leading-none uppercase">Profil <span class="text-emerald-600">Saya</span></h1>
            </div>
            <div class="flex gap-3">
                <a href="<?php echo e(route('anggota.keamanan')); ?>" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-emerald-600 transition-colors flex items-center gap-2 group bg-white/50 px-4 py-2 rounded-xl">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Keamanan Akun
                </a>
                <a href="<?php echo e(route('anggota.dashboard')); ?>" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-rose-500 transition-colors flex items-center gap-2 group">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Dashboard
                </a>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="mb-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl font-bold text-sm animate-fade-in shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="mb-8 flex items-center gap-3 bg-rose-50 border border-rose-100 text-rose-600 px-6 py-4 rounded-2xl font-bold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white/70 backdrop-blur-md rounded-[2.5rem] border border-white/50 shadow-xl overflow-hidden">
            <div class="p-8 md:p-12">
                
                <form action="<?php echo e(route('anggota.profil.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    
                    <div class="flex items-center gap-3 mb-8 px-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <h2 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400">Data Personal</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-1">Nomor Anggota (Tetap)</label>
                            <div class="bg-slate-100/50 rounded-2xl px-5 py-3.5 font-bold text-slate-500 italic text-sm border border-slate-100">
                                <?php echo e($anggota->nomor_anggota); ?>

                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3 ml-1">Email Akun</label>
                            <div class="bg-slate-100/50 rounded-2xl px-5 py-3.5 font-bold text-slate-500 italic text-sm border border-slate-100">
                                <?php echo e($user->email); ?>

                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-800 mb-3 ml-1">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="<?php echo e(old('nama_lengkap', $anggota->nama_lengkap)); ?>" 
                                   class="w-full bg-white border border-slate-200 rounded-2xl px-5 py-3.5 text-sm font-bold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-800 mb-3 ml-1">WhatsApp / Kontak</label>
                            <input type="text" name="kontak" value="<?php echo e(old('kontak', $anggota->kontak)); ?>" 
                                   class="w-full bg-white border border-slate-200 rounded-2xl px-5 py-3.5 text-sm font-bold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-800 mb-3 ml-1">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="<?php echo e(old('tgl_lahir', $anggota->tgl_lahir)); ?>" 
                                   class="w-full bg-white border border-slate-200 rounded-2xl px-5 py-3.5 text-sm font-bold focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all" id="tgl_lahir">
                            <p id="umurAlert" class="text-[10px] font-bold mt-2 px-1 hidden"></p>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-800 mb-3 ml-1">Foto Profil</label>
                            <div class="flex items-center gap-8 p-6 bg-slate-50/50 rounded-[2rem] border border-slate-100">
                                <div class="relative group/photo shrink-0">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)): ?>
                                        <img src="<?php echo e(Storage::url($anggota->foto_profil)); ?>" class="w-24 h-24 rounded-[1.5rem] object-cover border-2 border-white shadow-lg group-hover/photo:scale-105 transition-transform">
                                    <?php else: ?>
                                        <div class="w-24 h-24 bg-slate-200 rounded-[1.5rem] flex items-center justify-center text-[10px] font-black text-slate-400 uppercase text-center p-4 border-2 border-white">No Photo</div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="flex-1">
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mb-3 italic tracking-wider">Format: JPG, PNG (Max. 2MB)</p>
                                    <input type="file" name="foto_profil" 
                                           class="block w-full text-[10px] font-black text-slate-400 uppercase tracking-widest
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-xl file:border-0
                                                  file:text-[9px] file:font-black file:uppercase
                                                  file:bg-slate-800 file:text-white
                                                  hover:file:bg-emerald-600 file:transition-all file:cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <a href="<?php echo e(route('anggota.dashboard')); ?>" class="text-[10px] font-black uppercase text-slate-400 hover:text-rose-600 transition-colors">
                            ← Batal
                        </a>
                        <button type="submit" class="group relative bg-emerald-600 hover:bg-slate-800 text-white font-black px-10 py-4 rounded-2xl text-[10px] uppercase tracking-[0.2em] transition-all hover:shadow-xl hover:shadow-emerald-200 flex items-center gap-3">
                            Update Informasi Personal
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
</style>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tglLahirInput = document.getElementById('tgl_lahir');
        const umurAlert = document.getElementById('umurAlert');
        
        function hitungUmur(tanggalLahir) {
            const today = new Date();
            const birthDate = new Date(tanggalLahir);
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }
        
        function validasiUmur() {
            const tglLahir = tglLahirInput.value;
            
            if (!tglLahir) {
                umurAlert.classList.add('hidden');
                tglLahirInput.classList.remove('border-2', 'border-rose-500', 'bg-rose-50');
                return true;
            }
            
            const umur = hitungUmur(tglLahir);
            
            if (umur > 24) {
                umurAlert.classList.remove('hidden');
                umurAlert.innerHTML = '⚠️ Maaf, umur anda sudah melebihi batas maksimal (24 tahun)!';
                umurAlert.classList.add('text-rose-600');
                tglLahirInput.classList.add('border-2', 'border-rose-500', 'bg-rose-50');
                return false;
            } else {
                umurAlert.classList.add('hidden');
                tglLahirInput.classList.remove('border-2', 'border-rose-500', 'bg-rose-50');
                return true;
            }
        }
        
        tglLahirInput.addEventListener('change', validasiUmur);
        tglLahirInput.addEventListener('input', validasiUmur);
        
        if (tglLahirInput.value) {
            validasiUmur();
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\sibo\resources\views/anggota/profil/index.blade.php ENDPATH**/ ?>