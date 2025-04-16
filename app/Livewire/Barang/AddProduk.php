<?php

namespace App\Livewire\Barang;

use App\Models\kategori;
use App\Models\produk;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @brief Class AddProduk
 *
 * Class ini digunakan untuk menambahkan produk baru
 */
#[Layout('layouts.master')]
class AddProduk extends Component
{
    #[Title('Tambah Produk')]

    /**
     * @brief kode produk
     * @var string
     */
    public $kode;

    /**
     * @brief nama produk
     * @var string
     */
    public $produk;

    /**
     * @brief kategori produk
     * @var string
     */
    public $kat;

    /**
     * @brief satuan produk
     * @var string
     */
    public $satuan;

    /**
     * @brief margin produk
     * @var string
     */
    public $margin;

    /**
     * @brief diskon produk
     * @var string
     */
    public $discount;


    /**
     * @brief Mount method
     *
     * Method ini digunakan untuk mengatur nilai awal dari kode
     */
    public function mount()
    {
        $this->kode = session('kode', '');
    }

    /**
     * @brief Rule validation
     *
     * Rule ini digunakan untuk memvalidasi inputan user
     */
    protected $rules = [
        'kode' => 'required',
        'kat' => 'required',
        'satuan' => 'required',
        'margin' => 'required',
    ];

    /**
     * @brief Reset form
     *
     * Method ini digunakan untuk mengatur nilai awal dari form
     */
    public function resetForm()
    {
        $this->kode = '';
        $this->produk = '';
        $this->kat = '';
        $this->satuan = '';
        $this->margin = '';
        $this->discount = '';
    }

    /**
     * @brief Store method
     *
     * Method ini digunakan untuk menyimpan data produk ke database
     */
    public function store()
    {
        if (empty($this->discount)) {
            $this->discount = 0;
        }
        try {
            $this->validate();
            produk::create([
                'kode' => $this->kode,
                'produk' => $this->produk,
                'kategori_id' => $this->kat,
                'satuan' => $this->satuan,
                'margin' => $this->margin,
                'discount' => $this->discount
            ]);
            session()->flash('success', 'Produk berhasil ditambahkan');
            return redirect('produk')->with('');
        } catch (\Exception $e) {
            // You can log the error or handle it as needed
            Log::error('Error storing product: ' . $e->getMessage());
            session()->flash('error', 'There was an error saving the product');
        }
    }

    /**
     * @brief Update produk method
     *
     * Method ini digunakan untuk mengupdate data produk
     *
     * @param int $id id produk
     * @param string $field nama field yang akan diupdate
     * @param string $value nilai yang akan diupdate
     */
    public function updateProduk($id, $field, $value)
    {
        $produk = Produk::find($id);
        if ($produk) {
            $produk->$field = $value;
            $produk->save();
        }
        session()->flash('success', 'Produk berhasil ditambahkan');
    }

    /**
     * @brief Hapus produk method
     *
     * Method ini digunakan untuk menghapus data produk
     *
     * @param int $id id produk
     */
    public function destroy($id)
    {
        produk::where('id', $id)->delete();
        session()->flash('success', 'Produk berhasil dihapus!');
    }

    /**
     * @brief Render method
     *
     * Method ini digunakan untuk mengrender view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $data['kategoris'] = kategori::all();
        $data['produks'] = produk::all();
        return view('livewire.barang.add-produk')->with($data);
    }
}
