<x-app-layout>
    @include('inc.form')
    <div class="container mt-6">
        <form method="post" action="{{route('guru.update', $guru->id)}}" id="multiStepForm" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div id="step-1">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="nama" placeholder="name" value="{{ old('nama', $guru->nama) }}" required>
                            @error('nama')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Gelar</label>
                            <input type="text" class="form-control" name="gelar" placeholder="S.Ag, S.Pd" value="{{ old('gelar', $guru->gelar) }}" required>
                            @error('gelar')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" autocomplete="off" placeholder="example@mail.com" name="email" value="{{ old('email', $guru->email) }}" required>
                            @error('email')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" value="{{old('jenis_kelamin')}}">
                                <option value="Laki-laki" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tempat lahir</label>
                            <input type="text" class="form-control" name="tempat_tanggal_lahir" placeholder="Jakarta" value="{{ old('tempat_tanggal_lahir', $guru->tempat_tanggal_lahir) }}" required>
                            @error('tempat_tanggal_lahir')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal lahir</label>
                            <input type="date" class="form-control" value="{{ old('tanggal_lahir', $guru->tanggal_lahir->format('Y-m-d')) }}" required>
                            @error('tanggal_lahir')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. Handphone</label>
                            <input type="number" class="form-control" name="no_hp" value="{{ old('no_hp', $guru->no_hp) }}" required>
                            @error('no_hp')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. Rekening</label>
                            <input type="number" class="form-control" name="no_rekening" value="{{ old('no_rekening', $guru->no_rekening) }}" required>
                            @error('no_rekening')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Agama</label>
                            <select class="form-control" name="agama" required>
                                <option value="Islam" {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $guru->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Buddha" {{ old('agama', $guru->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ old('agama', $guru->agama) == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                <option value="Hindu" {{ old('agama', $guru->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Katolik" {{ old('agama', $guru->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            </select>
                            @error('agama')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="form-control" name="mapel" value="{{ old('mapel', $guru->mapel) }}" required>
                                <option value="matematika" selected>Matematika</option>
                                <option value="bahasa inggris">Bahasa inggris</option>
                            </select>
                            @error('mapel')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" rows="4" name="alamat">={{ old('alamat', $guru->alamat) }}</textarea>
                            @error('alamat')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-2" class="d-none">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div>
                            <label class="form-label">No. nik</label>
                            <input type="number" class="form-control" name="no_nik" value="{{ old('no_nik', $guru->no_nik) }}">
                            @error('no_nik')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. NUPTK</label>
                            <input type="number" class="form-control" name="no_nuptk" value="{{ old('no_gtk', $guru->no_gtk) }}" required>
                            @error('no_nuptk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">No. GTK</label>
                            <input type="number" class="form-control" name="no_gtk" value="{{ old('no_nuptk', $guru->no_nuptk) }}" required>
                            @error('no_gtk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nama Perguruan tinggi</label>
                            <input type="text" class="form-control" name="nama_lulusan_pt" placeholder="Universitas Indonesia" value="{{ old('nama_lulusan_pt', $guru->nama_lulusan_pt) }}" required>
                            @error('nama_lulusan_pt')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan_pt" placeholder="" value="{{ old('nama_jurusan_pt', $guru->nama_jurusan_pt) }}" required>
                            @error('nama_jurusan_pt')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Status Kepegawaian</label>
                            <select class="form-control" name="status_kepegawaian" >
                                <option value="Aktif" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak aktif" {{ old('status_kepegawaian', $guru->status_kepegawaian) == 'Tidak aktif' ? 'selected' : '' }}>Tidak aktif</option>
                            </select>
                            @error('status_kepegawaian')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input class="form-control" type="date" name="tanggal_masuk" id="" value="{{ old('tanggal_masuk', $guru->tanggal_masuk->format('Y-m-d')) }}" required>
                            @error('tanggal_masuk')
                                <div class="text-danger mt-2">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Keluar</label>
                            <input class="form-control" type="date" name="tanggal_keluar" id="" value="{{ old('tanggal_keluar', $guru->tanggal_keluar->format('Y-m-d')) }}" required>
                        </div>
                        @error('tanggal_keluar')
                                <div class="text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div id="step-3" class="d-none">
                <h1 class="text-center mb-6">Foto Ijazah</h1>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">SMP</label>
                        <input type="file" class="form-control" name="ijazah_smp" accept=".png" >
                        @error('ijazah_smp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">SMA</label>
                        <input type="file" class="form-control" name="ijazah_sma" accept=".png" >
                        @error('ijazah_sma')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">S1 (opsional)</label>
                        <input type="file" class="form-control" name="ijazah_s1" accept=".png">
                        @error('ijazah_s1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">S2 (opsional)</label>
                        <input type="file" class="form-control" name="ijazah_s2" accept=".png">
                        @error('ijazah_s2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">S3 (opsional)</label>
                        <input type="file" class="form-control" name="ijazah_s3" accept=".png">
                    </div>
                </div>
            </div>

            <div id="step-4" class="d-none">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">Foto</label>
                        <input type="file" class="form-control" name="foto" accept=".png">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="form-label fw-bold">FOTO KTP</label>
                        <input type="file" class="form-control" name="foto_ktp" accept=".png">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold">FOTO Surat Keterangan Mengajar</label>
                        <input type="file" class="form-control" name="foto_surat_keterangan_mengajar" accept="">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="form-label fw-bold" for="">Foto sertifikat (opsional)</label>
                        <input type="file" class="form-control" name="foto_sertifikat[]" multiple accept=".png, .jpeg, .jpg">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" class="btn btn-secondary" id="prevButton" style="display: none;">Previous</button>
                <button type="button" class="btn btn-primary" id="nextButton">Next</button>
                <button type="submit" class="btn btn-success d-none" id="submitButton">Submit</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const steps = ['step-1', 'step-2', 'step-3', 'step-4'];
            let currentStep = 0;

            const nextButton = document.getElementById('nextButton');
            const prevButton = document.getElementById('prevButton');
            const submitButton = document.getElementById('submitButton');

            const toggleVisibility = (element, condition) => {
                element.style.display = condition ? 'none' : 'inline-block';
            };

            const showStep = (step) => {
                steps.forEach((id, index) => {
                    document.getElementById(id).classList.toggle('d-none', index !== step);
                });
                toggleVisibility(prevButton, step === 0);
                toggleVisibility(nextButton, step === steps.length - 1);
                submitButton.classList.toggle('d-none', step !== steps.length - 1);
            };

            nextButton.addEventListener('click', function () {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            prevButton.addEventListener('click', function () {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            showStep(currentStep);
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sertifikatContainer = document.getElementById('sertifikatContainer');
            const addSertifikatButton = document.getElementById('addSertifikatButton');
            let sertifikatCount = 0;

            addSertifikatButton.addEventListener('click', function() {
                sertifikatCount++;
                const newSertifikat = document.createElement('div');
                newSertifikat.classList.add('col-lg-12', 'mb-3');
                newSertifikat.innerHTML = `
                    <label class="form-label fw-bold">Sertifikat ${sertifikatCount}</label>
                    <input type="file" class="form-control" name="sertifikat_${sertifikatCount}" accept=".png">
                `;
                sertifikatContainer.appendChild(newSertifikat);
            });
        });
    </script> --}}
</x-app-layout>
