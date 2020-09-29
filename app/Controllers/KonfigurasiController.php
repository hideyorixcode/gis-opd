<?php namespace App\Controllers;


class KonfigurasiController extends BaseController
{
    public function __construct()
    {
        $this->dataController = [
            'panel' => 'dashboard/konfigurasi/',
        ];
    }

    public function index()
    {
        $data = [
            'judul' => 'Konfigurasi Aplikasi',
        ];
        $data = array_merge($this->dataGlobal, $this->dataController, $data);
        return view('backend/admin/konfigurasi/view', $data);

    }

    public function read()
    {
        $m_konfigurasi = $this->mkonfigurasi;
        if ($this->reqService->getMethod(true) == 'POST') {
            $lists = $m_konfigurasi->get_datatables();
            $data = [];
            $no = $this->reqService->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no . '.';
                $row[] = '<strong>' . $list->label . '</strong>';
                $row[] = '<a href="javascript:void(0);" class="btn btn-info btn-sm btn-icon waves-effect waves-themed" title="Edit" onclick="edit(' . "'" . ($list->id) . "'" . ')"><span class="mdi mdi-comment-edit" aria-hidden="true"></span></a>';
                $row[] = '';
                $data[] = $row;
            }
            $output = ["draw" => $this->reqService->getPost('draw'),
                "recordsTotal" => $m_konfigurasi->count_all(),
                "recordsFiltered" => $m_konfigurasi->count_filtered(),
                "data" => $data];
            $output[csrf_token()] = csrf_hash();
            echo json_encode($output);
        }

    }

    public function edit($id)
    {
        $data = $this->mkonfigurasi->where('id', $id)->first();
        echo json_encode($data);
    }


    public function update()
    {

        $data['csrf_token'] = csrf_hash();
        $id = $this->request->getPost('id');
        $key = $this->request->getPost('key');
        $content = $this->request->getPost('content');
        if ($key == "logo") {
            $data_konfigurasi = $this->mkonfigurasi->where('id', $id)->first();
            if (!empty($_FILES['content']['name'])) {
                if (file_exists('public/img/' . $data_konfigurasi->content) && $data_konfigurasi->content)
                    unlink('public/img/' . $data_konfigurasi->content);
                $content = $this->request->getFile('content');
                $contentName = $content->getRandomName();
                $content->move(ROOTPATH . 'public/img/', $contentName);
            } else {
                $contentName = $data_konfigurasi->content;
            }

            $data['content'] = $contentName;


        } else {
            $data = array(
                'content' => $content
            );
        }

        $update = $this->mkonfigurasi->update($id, $data);
        if ($update) {
            $data_log = [
                //'log_time' => $timestamp,
                'log_id' => decodeHash($this->dataGlobal['sesi_id']),
                'log_description' => $this->dataGlobal['sesi_username'] . ' merubah konfigurasi ' . $key,
            ];
            $this->mlog->insert($data_log);
            $data = [
                'status' => TRUE,
                'message' => "Berhasil Mengubah Konfigurasi",
                'csrf_token' => csrf_hash()
            ];
            echo json_encode($data);

        } else {
            $data = [
                'status' => FALSE,
                'message' => "Gagal Mengubah Konfigurasi",
            ];
            echo json_encode($data);
            exit();
        }
    }


}
