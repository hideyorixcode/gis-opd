<?php namespace App\Controllers;


class PenggunaController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/pengguna/',
        ];
    }

    public function index()
    {
        $whereIn = ['ADMIN'];
        $data = [
            'judul' => 'Data Pengguna',
            'data_pengguna' => $this->mpengguna->whereIn('status', $whereIn)->paginate(9, 'link'),
            'pager' => $this->mpengguna->pager,
            'usernamebawaan' => $this->dataGlobal['sesi_username'],
            'pesan_kosong' => '<strong>Data Pengguna Masih Kosong ! </strong> Silahkan Tambah Pengguna',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/pengguna/view', $data);
    }

    public function view_data()
    {

        $whereIn = ['ADMIN'];
        $data = [
            'data_pengguna' => $this->mpengguna->whereIn('status', $whereIn)->paginate(9, 'link'),
            'pager' => $this->mpengguna->pager,
            'usernamebawaan' => $this->dataGlobal['sesi_username'],
            'pesan_kosong' => '<strong>Data Pengguna Masih Kosong ! </strong> Silahkan Tambah Pengguna',
        ];
        return view('backend/admin/pengguna/tampilData', $data);

    }

    public function search()
    {
        $TextCari = $this->request->getGet('teks');
        $whereIn = ['ADMIN'];
        if ($TextCari) {
            $data_pengguna_search = $this->mpengguna->groupStart()->like('username', $TextCari)->orLike('nama_unker', $TextCari)->groupEnd()->whereIn('status', $whereIn)->paginate(9, 'link');
            $data = [
                'judul' => 'Data Pengguna',
                'data_pengguna' => $data_pengguna_search,
                'usernamebawaan' => $this->dataGlobal['sesi_username'],
                'pager' => $this->mpengguna->pager,
                'pesan_kosong' => '<strong>Nama / Username yang anda cari tidak ditemukan ! </strong> Silahkan ketik pencarian lainnya',
            ];
            $data = array_merge($this->dataGlobal, $this->dataController, $data);
            return view('backend/admin/pengguna/tampilData', $data);
        } else {
            $data_pengguna_search = $this->mpengguna->whereIn('status', $whereIn)->paginate(9, 'link');
            $data = [
                'data_pengguna' => $data_pengguna_search,
                'usernamebawaan' => $this->dataGlobal['sesi_username'],
                'pager' => $this->mpengguna->pager,
                'pesan_kosong' => '<strong>Data Pengguna Masih Kosong ! </strong> Silahkan Tambah Pengguna',
            ];
            return view('backend/admin/pengguna/tampilData', $data);
        }
    }

    public function edit($id)
    {
        $data = $this->mpengguna->select(['username', 'nama_unker', 'logo', 'email', 'active'])->where('id', decodeHash($id))->first();
        echo json_encode($data);
    }

    public function create()
    {

        $nama_unker = $this->request->getPost('nama_unker');
        $password = $this->request->getPost('password');
        $email = strtolower($this->request->getPost('email'));
        $username = $this->request->getPost('username');
        $active = $this->request->getPost('active');

        //validasi
        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['komponen_error'] = [];
        $data['status_ajax'] = TRUE;
        $data['csrf_token'] = csrf_hash();

        $rules = [
            'nama_unker' => [
                'rules' => 'required|is_unique[unitkerja.nama_unker]',
                'errors' => [
                    'required' => 'Nama wajib diisi dan tidak boleh kosong',
                    'is_unique' => 'nama telah digunakan'
                ]
            ],

            'username' => [
                'rules' => 'required|is_unique[unitkerja.username]',
                'errors' => [
                    'required' => 'username wajib diisi dan tidak boleh kosong',
                    'is_unique' => 'username telah digunakan'
                ]
            ],

            'password' => [
                'rules' => 'min_length[6]',
                'errors' => [
                    'min_length' => 'minimal 6 karakter'
                ]
            ],
            'confirm_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password harus sama'
                ]
            ],

            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[unitkerja.email]',
                'errors' => [
                    'required' => 'Email Wajib diisi dan tidak boleh kosong',
                    'is_unique' => 'email telah digunakan',
                    'valid_email' => 'Email yang anda input tidak valid'
                ]
            ],

        ];

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
            $errors = $this->form_validation->getErrors();
            foreach ($errors as $key => $value) {
                $data['inputerror'][] = $key;
                $data['komponen_error'][] = 'error_' . $key;
                $data['error_string'][] = $value;
            }
            $data['status_ajax'] = FALSE;
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
                'nama_unker' => $nama_unker,
                'email' => $email,
                'username' => $username,
                'status' => 'ADMIN',
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'active' => $active,
                'logo' => $logoName,
            ];
            $data['status_ajax'] = TRUE;
        }

        if ($data['status_ajax'] === FALSE) {
            $data['csrf_token'] = csrf_hash();
            echo json_encode($data);
            exit();
        }

        //simpan
        $insert = $this->mpengguna->insert($data);
        if ($insert) {
            $data = [
                'status_ajax' => TRUE,
                'message' => "Berhasil Menambah Pengguna",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status_ajax' => FALSE,
                'message' => "Gagal Menambah Pengguna",
            ];
            echo json_encode($data);
            exit();
        }


    }

    public function update()
    {

        $id = $this->request->getPost('id');
        $dataMaster = getDataUser(decodeHash($id));
        $nama_unker_lama = $dataMaster['nama_unker'];
        $email_lama = $dataMaster['email'];
        $username_lama = $dataMaster['username'];
        $nama_unker = $this->request->getPost('nama_unker');
        $password = $this->request->getPost('password');
        $email = strtolower($this->request->getPost('email'));
        $username = $this->request->getPost('username');
        $active = $this->request->getPost('active');


        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];
        $data['komponen_error'] = [];
        $data['status_ajax'] = TRUE;
        $data['csrf_token'] = csrf_hash();


        $rules = [

            'active' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih Status',
                ]
            ],

        ];

        if ($nama_unker != $nama_unker_lama) {
            $rules += [
                'nama_unker' => [
                    'rules' => 'required|is_unique[unitkerja.nama_unker]',
                    'errors' => [
                        'required' => 'Nama wajib diisi dan tidak boleh kosong',
                        'is_unique' => 'nama telah digunakan'
                    ]
                ],

            ];
        }

        if ($username != $username_lama) {
            $rules += [
                'username' => [
                    'rules' => 'required|is_unique[unitkerja.username]',
                    'errors' => [
                        'required' => 'username wajib diisi dan tidak boleh kosong',
                        'is_unique' => 'username telah digunakan'
                    ]
                ],

            ];
        }

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

        if (!empty($password)) {
            $rules += [
                'password' => [
                    'rules' => 'min_length[6]',
                    'errors' => [
                        'min_length' => 'minimal 6 karakter'
                    ]
                ],
                'confirm_password' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'Konfirmasi password harus sama'
                    ]
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
            $errors = $this->form_validation->getErrors();
            foreach ($errors as $key => $value) {
                $data['inputerror'][] = $key;
                $data['komponen_error'][] = 'error_' . $key;
                $data['error_string'][] = $value;
            }
            $data['status_ajax'] = FALSE;
        } else {

            $logo = $this->request->getFile('logo');
            if ($logo->getError() == 4) {
                $logoName = $dataMaster["logo"];
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
                'email' => $email,
                'username' => $username,
                'status' => 'ADMIN',
                'active' => $active,
                'logo' => $logoName,
            ];

            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_BCRYPT);
            }

            $data['status_ajax'] = TRUE;

        }

        if ($data['status_ajax'] === FALSE) {
            $data['csrf_token'] = csrf_hash();
            echo json_encode($data);
            exit();
        }

        $update = $this->mpengguna->update(decodeHash($id), $data);
        if ($update) {
            $data = [
                'status_ajax' => TRUE,
                'message' => "Berhasil Mengubah Pengguna",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status_ajax' => FALSE,
                'message' => "Gagal Mengubah Pengguna",
            ];
            echo json_encode($data);
            exit();
        }


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
                'log_description' => $this->dataGlobal['sesi_username'] . ' menghapus data pengguna ' . $data_master["nama_unker"],
            ];
            $this->mlog->insert($data_log);
            $this->mpengguna->delete(decodeHash($id));
            $data = [
                'status' => TRUE,
                'message' => "Berhasil Menghapus pengguna",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status' => FALSE,
                'message' => "Gagal Menghapus pengguna",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);
        }

    }


}
