@extends('template.layout-admin')
@section('title_web', 'Ubah Data Pelanggan | Hema.Indonesia')
@section('content-admin')
    <div class="page-header">
        <div class="page-title">
            <h4>Ubah Data Pelanggan</h4>
            <h6>Mengubah data baru pelanggan</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('customerPut', $data->email) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $data->first_name }}" name="first_name" id="first_name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $data->last_name }}" name="last_name" id="last_name"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $data->email }}" name="email" id="email"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <div class="pass-group">
                                <input type="password" value="{{ $data->password }}" name="password" id="password"
                                    autocomplete="off" class="pass-input">
                                <span class="fas toggle-password fa-eye-slash"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="number" value="{{ $data->no_telp }}" name="no_telp" id="no_telp"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="select" name="gender" id="gender">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option {{ $data->gender == 'male' ? 'selected' : '' }} value="male">Pria | Laki-laki
                                </option>
                                <option {{ $data->gender == 'female' ? 'selected' : '' }} value="female">Wanita | Perempuan
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Umur | Usia</label>
                            <input type="number" value="{{ $data->age }}" name="age" id="age"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status Akun</label>
                            <select class="select" name="status" id="status">
                                <option value="">-- Pilih Status Akun --</option>
                                <option {{ $data->status == 'active' ? 'selected' : '' }} value="active">Aktif</option>
                                <option {{ $data->status == 'inactive' ? 'selected' : '' }} value="inactive">Tidak Aktif
                                </option>
                                <option {{ $data->status == 'banned' ? 'selected' : '' }} value="banned">Banned</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Profile</label>
                            <div class="image-upload">
                                <input name="profile_img" id="file_drop" type="file" onchange="updateFileName()">
                                <div class="image-uploads" id="upload-area">
                                    <img src="{{ asset('admin/img/icons/upload.svg') }}" alt="Upload Icon">
                                    <h4 id="file-name">Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ $data->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Ubah</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
@endsection
