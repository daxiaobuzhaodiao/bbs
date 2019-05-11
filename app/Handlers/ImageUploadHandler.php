<?php

namespace App\Handlers;

class ImageUploadHandler
{
    protected $allowed_ext = ['jpeg', 'jpg', 'png', 'gif'];

    function save($file, $folder, $file_prefix)
    {
        // 判断文件后缀是否合法
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        if(!in_array($extension, $this->allowed_ext)){
            return false;
        }

        // 制作文件存储目录  （1 拼接物理路径，2 拼接网络地址）
        $folderName = 'uploads/images/'.$folder.'/'.date('Ym/d');
        // 制作保存文件的物理路径
        $localPath = public_path() . '/' . $folderName;
        
        // 制作文件名称
        $fileName = $file_prefix . '_' . time() . str_random(10) . '.' . $extension;
        
        // 移动文件
        $file->move($localPath, $fileName);

        // 返回文件网路地址
        return [
            'path' => config('app.url'). '/' . $folderName . '/' . $fileName
        ];
    }
}