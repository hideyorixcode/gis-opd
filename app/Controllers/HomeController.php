<?php namespace App\Controllers;


class HomeController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
        ];
    }

    public function index_front()
    {
        $db = db_connect();
        $id_unker = $this->request->getGet('id-unit');
        $status = $this->request->getGet('status-unit');

        if ($id_unker != '') {
            if ($status != '') {
                $query = $db->query("SELECT * FROM unitkerja where status='$status' and id_unker like '%$id_unker%'");
            } else {
                $query = $db->query("SELECT * FROM unitkerja where id_unker like '%$id_unker%'");
            }
            $jumlahOPD = $this->mpengguna->like('id_unker', $id_unker . '0000')->first()['nama_unker'];
            $mode = '';
            // dd($jumlahOPD);
        } else {
            if ($status != '') {
                $query = $db->query("SELECT * FROM unitkerja where status='$status'");
            } else {
                $query = $db->query("SELECT * FROM unitkerja");
            }
            $jumlahOPD = $this->mpengguna->count_all_opd_aja();
            $mode = 'Total OPD';
        }

        $dataMaps = $query->getResult();
        // dd($dataMaps);
        $data = [
            'judul' => 'Dashboard',
            'getidunker' => $id_unker,
            'getstatus' => $status,
            'mode' => $mode,
            'dataOPD' => $this->mpengguna->select(['id', 'id_unker', 'nama_unker'])->where('status', 'OPD')->find(),
            'jumlahOPD' => $jumlahOPD,
            'jumlahUPTD' => $this->mpengguna->count_all_uptd_aja($id_unker),
            'jumlahCABDIN' => $this->mpengguna->count_all_cabdin_aja($id_unker),
            'jumlahGEDUNG' => $this->mpengguna->count_all_gedung_aja($id_unker),
            'dataMaps' => $dataMaps,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('viewDashboard', $data);
    }

    public function index()
    {
        $db = db_connect();
        $id_unker = $this->request->getGet('id-unit');
        $status = $this->request->getGet('status-unit');

        if ($id_unker != '') {
            if ($status != '') {
                $query = $db->query("SELECT * FROM unitkerja where status='$status' and id_unker like '%$id_unker%'");
            } else {
                $query = $db->query("SELECT * FROM unitkerja where id_unker like '%$id_unker%'");
            }
            $jumlahOPD = $this->mpengguna->like('id_unker', $id_unker . '0000')->first()['nama_unker'];
            $mode = '';
            // dd($jumlahOPD);
        } else {
            if ($status != '') {
                $query = $db->query("SELECT * FROM unitkerja where status='$status'");
            } else {
                $query = $db->query("SELECT * FROM unitkerja");
            }
            $jumlahOPD = $this->mpengguna->count_all_opd_aja();
            $mode = 'Total OPD';
        }

        $dataMaps = $query->getResult();
        // dd($dataMaps);
        $data = [
            'judul' => 'Dashboard',
            'getidunker' => $id_unker,
            'getstatus' => $status,
            'mode' => $mode,
            'dataOPD' => $this->mpengguna->select(['id', 'id_unker', 'nama_unker'])->where('status', 'OPD')->find(),
            'jumlahOPD' => $jumlahOPD,
            'jumlahUPTD' => $this->mpengguna->count_all_uptd_aja($id_unker),
            'jumlahCABDIN' => $this->mpengguna->count_all_cabdin_aja($id_unker),
            'jumlahGEDUNG' => $this->mpengguna->count_all_gedung_aja($id_unker),
            'dataMaps' => $dataMaps,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/dashboard/view', $data);
    }

    public function detail_opd($id)
    {
        $datadetail = $this->mpengguna->where('id_unker', $id)->first();
        $data = [
            'judul' => 'Detail OPD',
            'validation' => $this->form_validation,
            'data' => $datadetail,
            'id' => $id,

        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('detail-opd', $data);
    }

    public function detail_uptd($id)
    {
        $datadetail = $this->mpengguna->where('id_unker', $id)->first();
        $nama_opd = $this->mpengguna->select('nama_unker')->like('id_unker', substr($id, 0, 6))->first()['nama_unker'];
        $data = [
            'judul' => 'Detail OPD',
            'validation' => $this->form_validation,
            'data' => $datadetail,
            'nama_opd' => $nama_opd,
            'id' => $id,

        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('detail-uptd', $data);
    }

    public function ubahpw()
    {
        $data = [
            'judul' => 'Ubah Password',
            'validation' => $this->form_validation,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/ubahpw', $data);
    }

    public function update_password()
    {
        //inisiasi variabel
        $id = decodeHash($this->request->getPost('id'));
        $username = $this->request->getPost('username');
        $password_lama = $this->request->getPost('password_lama');
        $password_baru = $this->request->getPost('password');
        $password_konfirmasi = $this->request->getPost('confirm_password');
        //validasi
        $rules = [];
        $rules += [
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'password harus diisi',
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

        $cek_user = $this->mpengguna->where(['username' => $username])->get()->getRowArray();
        if ($cek_user) {
            $hash = $cek_user['password'];
            if (!password_verify($password_lama, $hash)) {
                $rules += [
                    'password_lama' => [
                        'rules' => 'required|is_not_unique[unitkerja.password,username,' . $username . ']',
                        'errors' => [
                            'required' => 'password lama harus ngehek',
                            'is_not_unique' => 'password lama tidak sesuai dengan di database'
                        ]
                    ],

                ];
            }
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/ubah-password'))->withInput();
        } else {
            $data = [
                'password' => password_hash($password_baru, PASSWORD_BCRYPT),
            ];

            $update = $this->mpengguna->update(($id), $data);
            if ($update) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_time' => $timestamp,
                    'log_id' => $id,
                    'log_description' => $this->dataGlobal['sesi_username'] . ' merubah password',
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Ubah Password');
                return redirect()->to(base_url('dashboard/profil'));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah Password');
                return redirect()->to(base_url('dashboard/profil'));
            }
        }

    }

    public function profil()
    {
        $data = [
            'judul' => 'Profil',
            'validation' => $this->form_validation,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        if ($this->dataGlobal['sesi_status'] == 'ADMIN') {
            return view('backend/admin/profil', $data);
        } else {
            return view('backend/profil', $data);
        }
    }

    public function ubah_profil()
    {
        $data = [
            'judul' => 'Ubah Profil',
            'validation' => $this->form_validation,
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        if ($this->dataGlobal['sesi_status'] == 'ADMIN') {
            return view('backend/admin/ubah-profil', $data);
        } else {
            return view('backend/ubah-profil', $data);
        }

    }

    public function update_profil()
    {
        //inisiasi variabel
        //,,,,, logo
        $id = decodeHash($this->request->getPost('id'));
        $nama_unker = $this->request->getPost('nama_unker');
        $username = $this->request->getPost('username');
        $singkatan_unker = $username;
        $alamat = $this->request->getPost('alamat');
        $no_telepon = $this->request->getPost('no_telepon');
        $email = strtolower($this->request->getPost('email'));
        $website = strtolower($this->request->getPost('website'));
        $data_pengguna = $this->read_by_id($id);
        $username_lama = $data_pengguna['username'];
        $email_lama = $data_pengguna['email'];

        //validasi
        $rules = [];
        $rules += [
            'nama_unker' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama_unker pengguna harus diisi.'
                ]
            ],
        ];

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

        if (!empty($_FILES['logo']['name'])) {
            $rules += [
                'logo' => [
                    //'rules' => 'ext_in[logo,png,jpg,gif,JPG,jpeg,JPEG]|max_size[logo,1024]',
                    'rules' => 'max_size[logo,1024]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        //'ext_in' => 'Tipe File Berupa Gambar',
                        'max_size' => 'Ukuran Maksimal Gambar 1 MB',
                        'is_image' => 'yang anda piih bukan gambar',
                        'mime_in' => 'yang anda piih bukan gambar',
                    ]
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to(base_url('dashboard/ubah-profil'))->withInput();

        } else {
            $logo = $this->request->getFile('logo');
            if ($logo->getError() == 4) {
                $remove_logo = $this->request->getPost('remove_logo');
                if ($remove_logo) // if remove foto checked
                {
                    if (file_exists('public/uploads/' . $remove_logo) && $remove_logo)
                        unlink('public/uploads/' . $remove_logo);
                    $logoName = '';
                } else {
                    $logoName = $data_pengguna["logo"];
                }
            } else {
                if (file_exists('public/uploads/' . $data_pengguna["logo"]) && $data_pengguna["logo"])
                    unlink('public/uploads/' . $data_pengguna["logo"]);
                $logoName = $logo->getRandomName();
                $logo->move(ROOTPATH . 'public/uploads/', $logoName);
            }

            $data = [
                'username' => $username,
                'email' => $email,
                'nama_unker' => $nama_unker,
                'singkatan_unker' => $singkatan_unker,
                'alamat' => $alamat,
                'website' => $website,
                'no_telepon' => $no_telepon,
                'logo' => $logoName
            ];

            $update = $this->mpengguna->update($id, $data);
            if ($update) {
                $timestamp = date("Y-m-d H:i:s");
                $data_log = [
                    'log_time' => $timestamp,
                    'log_id' => $id,
                    'log_description' => $this->dataGlobal['sesi_username'] . ' merubah data pribadi',
                ];
                $this->mlog->insert($data_log);
                session()->setFlashdata('sukses', 'Berhasil Ubah Data Profil');
                return redirect()->to(base_url('dashboard/profil'));

            } else {
                session()->setFlashdata('gagal', 'Gagal Ubah Data Profil');
                return redirect()->to(base_url('dashboard/profil'));
            }
        }

    }

    function read_by_id($id)
    {
        $data = $this->mpengguna->select(['username', 'active', 'id_unker', 'nama_unker', 'singkatan_unker', 'latitude', 'longitude', 'alamat', 'no_telepon', 'email', 'website', 'nip_pejabat', 'nama_pejabat', 'status', 'logo'])->where('id', $id)->first();
        return $data;
    }

    public function read()
    {
        if (session('hak_akses') == 'admin') {
            $m_pengguna = $this->mpengguna;
            if ($this->reqService->getMethod(true) == 'POST') {
                $lists = $m_pengguna->get_datatables();
                $data = [];
                $no = $this->reqService->getPost("start");
                foreach ($lists as $list) {
                    $no++;
                    $row = [];
                    $row[] = '<input type="checkbox" class="data-check" value="' . encodeHash($list->id) . '">';
                    $row[] = $no . '.';
                    $row[] = '<strong>' . $list->username . '</strong>';
                    //$row[] = $list->nama_unker;
                    $row[] = encodeHash($list->id);
                    $row[] = $list->no_telepon;
                    $row[] = $list->email;
                    $row[] = $list->active == 1 ? '<label class="text-success"> <i class="fal fa-check-square"></i> Aktif </label>' : '<label class="text-danger"> <i class="fal fa-times"></i> Tidak Aktif </label>';
                    if ($list->logo) {
                        $logo = '<a href="' . base_url('public/uploads/' . $list->logo) . '" target="_blank"><img src="' . base_url('public/uploads/' . $list->logo) . '"  width="50px;" height="50px;" alt=""/></a>';
                    } else {
                        $logo = '<a href="' . base_url('public/uploads/laki-laki.jpg') . '" target="_blank"><img src="' . base_url('public/uploads/resize/laki-laki.jpg') . '"  width="50px;" height="50px;" alt=""/></a>';
                    }
                    $row[] = $logo;
                    $row[] = '<a href="javascript:void(0);" class="btn btn-info btn-sm btn-icon waves-effect waves-themed" title="Edit" onclick="edit(' . "'" . encodeHash($list->id) . "'" . ')"><span class="fal fa-edit" aria-hidden="true"></span></a> <a href="javascript:void(0);" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" title="Delete" onclick="delete_id(' . "'" . encodeHash($list->id) . "'" . ')"><span class="fal fa-trash" aria-hidden="true"></span></a>';
                    $data[] = $row;
                }
                $output = ["draw" => $this->reqService->getPost('draw'),
                    "recordsTotal" => $m_pengguna->count_all(),
                    "recordsFiltered" => $m_pengguna->count_filtered(),
                    "data" => $data];
                $output[csrf_token()] = csrf_hash();
                echo json_encode($output);
            }
        }
    }

}
