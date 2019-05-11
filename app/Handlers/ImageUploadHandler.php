<?php

namespace App\Handlers;

use Image;

class ImageUploadHandler
{
    protected $allowed_ext = ['jpeg', 'jpg', 'png', 'gif'];

    function save($file, $folder, $file_prefix, $max_width = false)
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

        // 按照规定的大小裁剪图片
        if($max_width && $extension != 'gif') {
            $this->reduceSize($localPath. '/'. $fileName, $max_width);
        }

        // 返回文件网路地址
        return [
            'path' => config('app.url'). '/' . $folderName . '/' . $fileName
        ];
    }

    // 裁剪图片
    public function reduceSize($file, $max_width)
    {
        // $file 是图片的物理路径
        $image = Image::make($file);
        // 进行大小调整
        $image->resize($max_width, null, function($constraint) {
            // 设置宽度， 高度为等比例缩放
            $constraint->aspectRatio();
            // 防止裁剪图片时，图片尺寸变大
            $constraint->upsize();
        });
        // 保存修改后的图片
        $image->save();
    }
}