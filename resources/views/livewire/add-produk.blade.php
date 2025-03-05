<div>
    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('dashboard') }}" wire:navigate>
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('add-produk') }}" wire:navigate>Forms</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambahkan Produk</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="">
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode Produk</label>
                                <input type="text" id="kode" wire:model="kode" class="form-control">
                                @error('kode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email2">Nama produk</label>
                                <input type="text" livewire:model="produk" class="form-control"
                                    placeholder="nama produk">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kategori</label>
                                <select class="form-select" livewire:model="kategori">
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Satuan</label>
                                <select class="form-select" livewire:model="satuan">
                                    <option>pcs</option>
                                    <option>Box</option>
                                    <option>Renceng</option>
                                    <option>Set</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email2">Margin</label>
                                <input type="number" livewire:model="margin" class="form-control"
                                    placeholder="presentase %">
                            </div>
                            <div class="form-group">
                                <label for="email2">discount</label>
                                <input type="number" livewire:model="discount" class="form-control"
                                    placeholder="Opsional">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button class="btn btn-success">Submit</button>
                    <button class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</div>
