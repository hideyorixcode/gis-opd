<?php namespace App\Controllers;


class OpdController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/opd/',
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Daftar OPD',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/opd/view', $data);
    }

    public function read()
    {
        $mopd = $this->mpengguna;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mopd->get_datatables_opd();
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
                $row[] = $list->no_telepon;
                $row[] = $list->email;
                $row[] = $list->website;
                $row[] = '<a href="' . base_url('dashboard/opd/detail/' . encodeHash($list->id)) . '" class="btn btn-info btn-sm waves-effect waves-themed" title="Detail" ><span class="mdi mdi-eye-check" aria-hidden="true"></span></a>
<a href="' . base_url('dashboard/opd/edit/' . encodeHash($list->id)) . '" class="btn btn-success btn-sm waves-effect waves-themed" title="Edit" ><span class="mdi mdi-pencil" aria-hidden="true"></span></a>
 <a href="javascript:void(0);" class="btn btn-danger btn-sm waves-effect waves-themed" title="Delete" onclick="delete_opd(' . "'" . encodeHash($list->id) . "'" . ')"><span class="mdi mdi-trash-can-outline" aria-hidden="true"> </span></a>';
                $row[] = '';

                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mopd->count_all_opd(),
                "recordsFiltered" => $mopd->count_filtered_opd(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }


    }

    public function cetak()
    {
        $kabupaten_kota = $this->request->getGet('kabupaten_kota');
        $data = [
            'judul' => 'Cetak OPD ',
            'kab_kota' => $kabupaten_kota
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/opd/cetak', $data);
    }

    public function read_cetak()
    {
        $mopd = $this->mpengguna;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $mopd->get_datatables_opd();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->nama_unker;
                $row[] = $list->alamat;
                $row[] = '';

                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $mopd->count_all_opd(),
                "recordsFiltered" => $mopd->count_filtered_opd(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }


    }

    public function form()
    {

        $data = [
            'judul' => 'Form Tambah OPD',
            'validation' => $this->form_validation,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/opd/form', $data);
    }

    //JANGAN DIHAPUS

    public function create()
    {
        $db = db_connect();
        $query_get_id = $db->query("SELECT SUBSTRING(id_unker, 1, 6) AS id_unker FROM unitkerja ORDER BY SUBSTRING(id_unker, 1, 6) DESC LIMIT 1");
        $dataId = $query_get_id->getRow();
        $getIDUnker = ($dataId->id_unker + 1) . '0000';
        //die();
        //1014010000
        //1014020000
        //$getIDUnker = $dataId[0]['id_unker'].'0000';
        //echo $getIDUnker;
        //die();

        //$id_unker = $this->request->getPost('id_unker');
        $id_unker = $getIDUnker;
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
        $status = $this->request->getPost('status');
        $username = $id_unker . '_' . $status;
        $password = '123456';
        $active = 1;

        $rules = [];
        $rules += [
            'nama_unker' => [
                'rules' => 'required|is_unique[unitkerja.nama_unker]',
                'errors' => [
                    'required' => 'nama lengkap OPD harus diisi.',
                    'is_unique' => 'Nama OPD telah digunakan'
                ]
            ],
        ];

        if ($singkatan_unker) {

            $rules += [
                'singkatan_unker' => [
                    'rules' => 'is_unique[unitkerja.singkatan_unker]',
                    'errors' => [
                        'is_unique' => 'Singkatan OPD telah digunakan'
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
            return redirect()->to(base_url('dashboard/opd/form'))->withInput();
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
                'active' => $active,
                'id_unker' => $id_unker,
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
                'created_by' => decodeHash($this->dataGlobal['sesi_id']),
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
                'logo' => $logoName,
            ];

            $insert = $this->mpengguna->insert($data);

            if ($insert) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' Menambah Data OPD ' . $nama_unker,
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Tambah OPD');
                return redirect()->to(base_url('dashboard/opd'));

            } else {
                session()->setFlashdata('gagal', 'Gagal Tambah OPD');
                return redirect()->to(base_url('dashboard/opd'));
            }
        }
    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Form Edit OPD',
            'validation' => $this->form_validation,
            'data' => getDataUser(decodeHash($id)),
            'id' => $id,

        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/opd/edit', $data);
    }

    public function getIDOPD($id)
    {
        $data = $this->mpengguna->select(['id_unker'])->where('id', $id)->first();
        echo json_encode($data);
    }


    public function update()
    {
        $id = $this->request->getPost('id');
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
        $status = $this->request->getPost('status');
        $active = 1;

        $dataMaster = getDataUser(decodeHash($id));
        $id_unker_lama = $dataMaster['id_unker'];
        $nama_unker_lama = $dataMaster['nama_unker'];
        $singkatan_unker_lama = $dataMaster['singkatan_unker'];
        $email_lama = $dataMaster['email'];
        $username_lama = $dataMaster['username'];

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
                        'required' => 'nama lengkap OPD harus diisi.',
                        'is_unique' => 'Nama OPD telah digunakan'
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
                            'is_unique' => 'Singkatan OPD telah digunakan'
                        ]
                    ],
                ];
            }
        }


        if ($email) {
            if ($email != $email_lama) {
                $rules += [
                    'email' => [
                        'rules' => 'valid_email',
                        'errors' => [
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
            //dd($this->form_validation);
            return redirect()->to(base_url('dashboard/opd/edit/' . $id))->withInput();
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
                'active' => $active,
                'updated_by' => decodeHash($this->dataGlobal['sesi_id']),
                'logo' => $logoName,
            ];

            $update = $this->mpengguna->update(decodeHash($id), $data);

            if ($update) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_id_user' => decodeHash($this->dataGlobal['sesi_id']),
                    'log_description' => $this->dataGlobal['sesi_username'] . ' Merubah Data OPD ' . $nama_unker,
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Ubah OPD');
                return redirect()->to(base_url('dashboard/opd'));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah OPD');
                return redirect()->to(base_url('dashboard/opd'));
            }
        }
    }

    public function detail($id)
    {
        $data = [
            'judul' => 'Detail OPD',
            'validation' => $this->form_validation,
            'data' => getDataUser(decodeHash($id)),
            'id' => $id,

        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/opd/detail', $data);
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
                'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data OPD ' . $data_master["nama_unker"],
            ];
            $this->mlog->insert($data_log);
            $this->mpengguna->delete(decodeHash($id));
            $data = [
                'status' => TRUE,
                'message' => "Berhasil Menghapus OPD",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status' => FALSE,
                'message' => "Gagal Menghapus OPD",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);
        }

    }


}
