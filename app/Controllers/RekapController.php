<?php namespace App\Controllers;


class RekapController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/rekap/',
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Rekap Seluruh Perangkat Daerah',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/rekap/view', $data);
    }

    public function read()
    {
        $muptd = $this->mpengguna;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $muptd->get_datatables_rekap();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_unker;
                if ($list->status == 'OPD') {
                    $row[] = '';
                } else {
                    $nama_opd = $this->mpengguna->select('nama_unker')->like('id_unker', substr($list->id_unker, 0, 6))->first()['nama_unker'];
                    $row[] = $nama_opd;
                }

                $row[] = $list->alamat;
                $row[] = $list->status;
                $row[] = $list->no_telepon;
                $row[] = $list->email;
                $row[] = $list->website;
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $muptd->count_all_rekap(),
                "recordsFiltered" => $muptd->count_filtered_rekap(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }


    }

    public function cetak()
    {
        $kabupaten_kota = $this->request->getGet('kabupaten_kota');
        $statusPost = $this->request->getGet('statusPost');
        $data = [
            'judul' => 'Cetak Rekap',
            'kabupaten_kota' => $kabupaten_kota,
            'statusPost' => $statusPost,

        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/rekap/cetak', $data);
    }

    public function read_cetak()
    {
        $muptd = $this->mpengguna;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $muptd->get_datatables_rekap();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_unker;
                if ($list->status == 'OPD') {
                    $row[] = '';
                } else {
                    $nama_opd = $this->mpengguna->select('nama_unker')->like('id_unker', substr($list->id_unker, 0, 6))->first()['nama_unker'];
                    $row[] = $nama_opd;
                }
                $row[] = $list->alamat;
                $row[] = $list->status;
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $muptd->count_all_rekap(),
                "recordsFiltered" => $muptd->count_filtered_rekap(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }


    }


}
