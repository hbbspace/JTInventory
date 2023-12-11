<?php
class Teknisi {
    private $nip;
    private $namaTeknisi;
    private $jenisKelamin;

    public function __construct($nip, $namaTeknisi, $jenisKelamin) {
        $this->nip = $nip;
        $this->namaTeknisi = $namaTeknisi;
        $this->jenisKelamin = $jenisKelamin;
    }

    // Getter dan setter untuk setiap atribut
    public function getNip() {
        return $this->nip;
    }

    public function setNip($nip) {
        $this->nip = $nip;
    }

    public function getNamaTeknisi() {
        return $this->namaTeknisi;
    }

    public function setNamaTeknisi($namaTeknisi) {
        $this->namaTeknisi = $namaTeknisi;
    }

    public function getJenisKelamin() {
        return $this->jenisKelamin;
    }

    public function setJenisKelamin($jenisKelamin) {
        $this->jenisKelamin = $jenisKelamin;
    }

    public function __toString() {
        return "Teknisi { nip='" . $this->nip . "', nama_teknisi='" . $this->namaTeknisi . "', jk=" . $this->jenisKelamin . " }";
    }
}
?>