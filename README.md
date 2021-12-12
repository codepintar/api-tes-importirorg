Study Case Backend

* Framework Laravel
* Login Auth menggunakan JWT

API ini terdiri dari : <br>
* Register
* Login
* Kategori (CRUD)
* Barang (CRUD)
* Barang Masuk dan Keluar (CRUD)
* Laporan Stok
* Laporan Barang Masuk dan Barang Keluar

Prosedur penggunaaan : 
- User Register
- User Login , nanti returnnya mendapatkan Token JWT,
- Setiap Request Data atau melakukan proses CRUD di POSTMANT wajib menyertakan Authorization -> Bearer Token -> Masukan token yang di ambil dari Proses Login

Role akses usernya : <br>
=> admin  : (username : admin@yahoo.com and password : 123456) <br>
=> gudang : (username : gudang@yahoo.com and password : 123456)


# api-tes-importirorg
