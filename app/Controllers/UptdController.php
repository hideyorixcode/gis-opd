<?php namespace App\Controllers;


class UptdController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/uptd-cabdin/',
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Daftar UPTD / CABDIN',
            'dataOPD' => $this->mpengguna->select(['id', 'id_unker', 'nama_unker'])->where('status', 'OPD')->find(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/uptd/view', $data);
    }

    public function read()
    {
        $muptd = $this->mpengguna;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $muptd->get_datatables_uptd();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_unker;
                $row[] = $list->username;
                $row[] = $list->nama_pejabat;
                $row[] = $list->alamat;
                $row[] = $list->status;
                $row[] = $list->no_telepon;
                $row[] = $list->email;
                $row[] = $list->website;
                $row[] = '<a href="' . base_url('dashboard/uptd-cabdin/detail/' . encodeHash($list->id)) . '" class="btn btn-info btn-sm waves-effect waves-themed" title="Detail" ><span class="mdi mdi-eye-check" aria-hidden="true"></span></a>
<a href="' . base_url('dashboard/uptd-cabdin/edit/' . encodeHash($list->id)) . '" class="btn btn-success btn-sm waves-effect waves-themed" title="Edit" ><span class="mdi mdi-pencil" aria-hidden="true"></span></a>
 <a href="javascript:void(0);" class="btn btn-danger btn-sm waves-effect waves-themed" title="Delete" onclick="delete_uptd(' . "'" . encodeHash($list->id) . "'" . ')"><span class="mdi mdi-trash-can-outline" aria-hidden="true"> </span></a>';
                $row[] = '';

                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $muptd->count_all_uptd(),
                "recordsFiltered" => $muptd->count_filtered_uptd(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }


    }

    public function cetak()
    {
        $kabupaten_kota = $this->request->getGet('kabupaten_kota');
        $statusPost = $this->request->getGet('statusPost');
        if ($this->request->getGet('id_unker_opd') != '') {
            $explode = explode('|', $this->request->getGet('id_unker_opd'));
            $id_unker_opd = $explode[0];
            $unker_opd = $explode[1];
        } else {
            $id_unker_opd = '';
            $unker_opd = '';
        }

        $data = [
            'judul' => 'Cetak UPTD/CABDIN/GEDUNG',
            'kabupaten_kota' => $kabupaten_kota,
            'statusPost' => $statusPost,
            'id_unker_opd' => $id_unker_opd,
            'unker_opd' => $unker_opd,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/uptd/cetak', $data);
    }

    public function read_cetak()
    {
        $muptd = $this->mpengguna;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $muptd->get_datatables_uptd();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_unker;
                $row[] = $list->alamat;
                $row[] = $list->status;
                $row[] = '';

                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $muptd->count_all_uptd(),
                "recordsFiltered" => $muptd->count_filtered_uptd(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }


    }

    public function form()
    {
        $data = [
            'judul' => 'Form Tambah UPTD / CABDIN',
            'validation' => $this->form_validation,
            'dataOPD' => $this->mpengguna->select(['id', 'id_unker', 'nama_unker'])->where('status', 'OPD')->find(),
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/uptd/form', $data);
    }

    public function create()
    {

        $db = db_connect();
        $selectOPD = $this->request->getPost('selectOPD');
        $query_get_id = $db->query("SELECT SUBSTRING(id_unker, 7, 4) AS id_unker FROM unitkerja WHERE SUBSTRING(id_unker, 1, 6) = '$selectOPD'  ORDER BY SUBSTRING(id_unker, 7, 4) DESC LIMIT 1");
        $dataId = $query_get_id->getRow();
        $getIDUnker = ($selectOPD . '' . $dataId->id_unker) + 1;

        // $id_unker_mix = $this->request->getPost('id_unker_mix');
        $id_unker_mix = $getIDUnker;
        $nama_unker = $this->request->getPost('nama_unker');
        $singkatan_unker = $this->request->getPost('singkatan_unker');
        $latitude = $this->request->getPost('latitude');
        $longitude = $this->request->getPost('longitude');
        $alamat = $this->request->getPost('alamat');
        $no_telepon = $this->request->getPost('no_telepon');
        $email = $this->request->getPost('email');
        $website = $this->request->getPost('website');
        $nip_pejabat = $this->request->getPost('nip_pejabat');
        $nama_pejabat = $this->request->getPost('nama_pejabat');
        $status = $this->request->getPost('statusSelect');
        $username = $id_unker_mix . '_' . $status;
        $password = '123456';
        $active = 1;

        $rules = [];
        $rules += [
            'nama_unker' => [
                'rules' => 'required|is_unique[unitkerja.nama_unker]',
                'errors' => [
                    'required' => 'nama lengkap ' . $status . ' harus diisi.',
                    'is_unique' => 'Nama ' . $status . ' telah digunakan'
                ]
            ],
        ];

        if ($singkatan_unker) {
            $rules += [
                'singkatan_unker' => [
                    'rules' => 'is_unique[unitkerja.singkatan_unker]',
                    'errors' => [
                        'is_unique' => 'Singkatan ' . $status . ' telah digunakan'
                    ]
                ],
            ];
        }

        if ($email) {
            $rules += [
                'email' => [
                    'rules' => 'valid_email',
                    'errors' => [
                        'valid_email' => 'Email yang anda input tidak valid'
                    ]
                ],
            ];
        }

        if ($no_telepon) {
            $rules += [
                'rules' => 'max_length[20]|numeric',
                'errors' => [
                    'numeric' => 'nomor telepon harus berupa angka',
                    'max_length' => 'maksimal 20 karakter'
                ],
            ];
        }


        if (!empty($_FILES['logo']['name'])) {
            $rules += [
                'logo' => [
                    'rules' => 'ext_in[logo,png,jpg,gif,JPG,jpeg,JPEG]|max_size[logo,1024]',
                    'errors' => [
                        'ext_in' => 'Tipe File Berupa Gambar',
                        'max_size' => 'Ukuran Maksimal logo / Foto 1 MB',
                    ]
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/uptd-cabdin/form'))->withInput();
        } else {
            $logo = $this->request->getFile('logo');
            if ($logo->getError() == 4) {
                $logoName = '';
            } else {
                $logo = $this->request->getFile('logo');
                $logoName = $logo->getRandomName();
                $logo->move(ROOTPATH . 'public/uploads/', $logoName);
            }

            $data = [
                'username' => $username,
                'id_unker' => $id_unker_mix,
                'nama_unker' => $nama_unker,
                'singkatan_unker' => $singkatan_unker,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'alamat' => $alamat,
                'no_telepon' => $no_telepon,
                'email' => $email,
                'website' => $website,
                'nip_pejabat' => $nip_pejabat,
                'nama_pejabat' => $nama_pejabat,
                'status' => $status,
                'active' => $active,
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
                'logo' => $logoName,
            ];

            $insert = $this->mpengguna->insert($data);

            if ($insert) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' Menambah Data ' . $status . ' ' . $nama_unker,
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Tambah ' . $status . '');
                return redirect()->to(base_url('dashboard/uptd-cabdin'));

            } else {
                session()->setFlashdata('gagal', 'Gagal Tambah ' . $status . '');
                return redirect()->to(base_url('dashboard/uptd-cabdin'));
            }
        }
    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Form Edit ' . getDataUser(decodeHash($id))['status'],
            'validation' => $this->form_validation,
            'data' => getDataUser(decodeHash($id)),
            'dataOPD' => $this->mpengguna->select(['id', 'id_unker', 'nama_unker'])->where('status', 'OPD')->find(),
            'id' => $id,

        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/uptd/edit', $data);
    }


    public function update()
    {
        $id = $this->request->getPost('id');
        $dataMaster = getDataUser(decodeHash($id));
        $id_unker_lama = $dataMaster['id_unker'];
        $nama_unker_lama = $dataMaster['nama_unker'];
        $singkatan_unker_lama = $dataMaster['singkatan_unker'];
        $email_lama = $dataMaster['email'];
        $db = db_connect();

        $selectOPD = $this->request->getPost('selectOPD');
        if ($selectOPD != substr($id_unker_lama, 0, 6)) {
            $query_get_id = $db->query("SELECT SUBSTRING(id_unker, 7, 4) AS id_unker FROM unitkerja WHERE SUBSTRING(id_unker, 1, 6) = '$selectOPD'  ORDER BY SUBSTRING(id_unker, 7, 4) DESC LIMIT 1");
            $dataId = $query_get_id->getRow();
            $getIDUnker = ($selectOPD . '' . $dataId->id_unker) + 1;
            $id_unker_mix = $getIDUnker;
        } else {
            $id_unker_mix = $dataMaster['id_unker'];
        }
        //$id_unker_mix = $this->request->getPost('id_unker_mix');
        $nama_unker = $this->request->getPost('nama_unker');
        $singkatan_unker = $this->request->getPost('singkatan_unker');
        $latitude = $this->request->getPost('latitude');
        $longitude = $this->request->getPost('longitude');
        $alamat = $this->request->getPost('alamat');
        $no_telepon = $this->request->getPost('no_telepon');
        $email = $this->request->getPost('email');
        $website = $this->request->getPost('website');
        $nip_pejabat = $this->request->getPost('nip_pejabat');
        $nama_pejabat = $this->request->getPost('nama_pejabat');
        $status = $this->request->getPost('statusSelect');
        $username = $id_unker_mix . '_' . $status;
        //$password = '123456';
        $active = 1;


        $rules = [];

        $rules += [
            'logo' => [
                'rules' => 'ext_in[logo,png,jpg,gif,JPG,jpeg,JPEG]|max_size[logo,1024]',
                'errors' => [
                    'ext_in' => 'Tipe File Berupa Gambar',
                    'max_size' => 'Ukuran Maksimal logo / Foto 1 MB',
                ]
            ],
        ];

        if ($no_telepon) {
            $rules += [
                'no_telepon' => [
                    'rules' => 'max_length[20]|numeric',
                    'errors' => [
                        'numeric' => 'nomor telepon harus berupa angka',
                        'max_length' => 'maksimal 20 karakter'
                    ]
                ],

            ];
        }

        if ($nama_unker != $nama_unker_lama) {
            $rules += [
                'nama_unker' => [
                    'rules' => 'required|is_unique[unitkerja.nama_unker]',
                    'errors' => [
                        'required' => 'nama lengkap ' . $status . ' harus diisi.',
                        'is_unique' => 'Nama ' . $status . ' telah digunakan'
                    ]
                ],
            ];
        }
        if ($singkatan_unker) {
            if ($singkatan_unker != $singkatan_unker_lama) {
                $rules += [
                    'singkatan_unker' => [
                        'rules' => 'is_unique[unitkerja.singkatan_unker]',
                        'errors' => [
                            'is_unique' => 'Singkatan ' . $status . ' telah digunakan'
                        ]
                    ],
                ];
            }
        }


        if ($email) {
            if ($email != $email_lama) {
                $rules += [
                    'email' => [
                        'rules' => 'required|valid_email|is_unique[unitkerja.email]',
                        'errors' => [
                            'required' => 'Email Wajib diisi dan tidak boleh kosong',
                            'is_unique' => 'email telah digunakan',
                            'valid_email' => 'Email yang anda input tidak valid'
                        ]
                    ],
                ];
            }
        }


        // if (!empty($_FILES['logo']['name'])) {
        //     $rules += [
        //         'logo' => [
        //             'rules' => 'ext_in[logo,png,jpg,gif,JPG,jpeg,JPEG]|max_size[logo,1024]',
        //             'errors' => [
        //                 'ext_in' => 'Tipe File Berupa Gambar',
        //                 'max_size' => 'Ukuran Maksimal logo / Foto 1 MB',
        //             ]
        //         ],
        //     ];
        // }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/uptd-cabdin/edit/' . $id))->withInput();
        } else {
            $logo = $this->request->getFile('logo');
            if ($logo->getError() == 4) {
                $remove_logo = $this->request->getPost('remove_logo');
                if ($remove_logo) // if remove picture checked
                {
                    if (file_exists('public/uploads/' . $remove_logo) && $remove_logo) {
                        unlink('public/uploads/' . $remove_logo);
                    }
                    $logoName = '';
                } else {
                    $logoName = $dataMaster["logo"];
                }
            } else {
                if (file_exists('public/uploads/' . $dataMaster["logo"]) && $dataMaster["logo"]) {
                    unlink('public/uploads/' . $dataMaster["logo"]);
                }
                $logo = $this->request->getFile('logo');
                $logoName = $logo->getRandomName();
                $logo->move(ROOTPATH . 'public/uploads/', $logoName);
            }
            $data = [
                'username' => $username,
                'active' => $active,
                'id_unker' => $id_unker_mix,
                'nama_unker' => $nama_unker,
                'singkatan_unker' => $singkatan_unker,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'alamat' => $alamat,
                'no_telepon' => $no_telepon,
                'email' => $email,
                'website' => $website,
                'nip_pejabat' => $nip_pejabat,
                'nama_pejabat' => $nama_pejabat,
                'status' => $status,
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
                'logo' => $logoName,
            ];


            $update = $this->mpengguna->update(decodeHash($id), $data);

            if ($update) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' Merubah Data ' . $status . ' ' . $nama_unker,
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Ubah ' . $status);
                return redirect()->to(base_url('dashboard/uptd-cabdin'));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah ' . $status);
                return redirect()->to(base_url('dashboard/uptd-cabdin'));
            }
        }
    }

    public function detail($id)
    {
        $id_unker = getDataUser(decodeHash($id))['id_unker'];
        $nama_opd = $this->mpengguna->select('nama_unker')->like('id_unker', substr($id_unker, 0, 6))->first()['nama_unker'];
        $data = [
            'judul' => 'Detail ' . getDataUser(decodeHash($id))['status'],
            'validation' => $this->form_validation,
            'data' => getDataUser(decodeHash($id)),
            'nama_opd' => $nama_opd,
            'id' => $id,

        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/uptd/detail', $data);
    }

    public function delete($id)
    {
        $data_master = $this->mpengguna->where('id', decodeHash($id))->first();
        if ($data_master) {
            if ($data_master["logo"]) {
                if (file_exists('public/uploads/' . $data_master["logo"]) && $data_master["logo"])
                    unlink('public/uploads/' . $data_master["logo"]);
            }
            $data_log = [
                //'log_time' => $timestamp,
                'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data ' . $data_master["status"] . ' ' . $data_master["nama_unker"],
            ];
            $this->mlog->insert($data_log);
            $this->mpengguna->delete(decodeHash($id));
            $data = [
                'status' => TRUE,
                'message' => "Berhasil Menghapus " . $data_master["status"],
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status' => FALSE,
                'message' => "Gagal Menghapus " . $data_master["status"],
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);
        }

    }


}
