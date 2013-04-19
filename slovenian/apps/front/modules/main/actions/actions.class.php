<?php

class mainActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        
    }

    public function executeAjax_render_component(sfWebRequest $request) {
        $moduleName = $request->getParameter('module_name');
        $componentName = $request->getParameter('component_name');
        echo $this->getComponent($moduleName, $componentName);
        exit;
    }

    public function executeFile_upload(sfWebRequest $request) {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $folder = $request->getParameter('folder');

            $user = sfGuardUserPeer::retrieveByPK($request->getParameter('hash', null));

            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $folder . '/';
            $targetFile = str_replace('//', '/', $targetPath) . $request->getParameter('filename') . '.' . pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);

            if ($_FILES['Filedata']['size'] > sfConfig::get('profile_image_size')) {
                $this->forward404();
            }

            foreach (glob($targetPath . '*.*') as $v) {
                unlink($v);
            }

            $user->getProfile()->setImageUrl($request->getParameter('filename') . '.' . pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION));
            $user->getProfile()->save();

            $types = array('image/pjpeg', 'image/jpeg', 'image/gif', 'image/png', 'application/octet-stream');
            if (!in_array($_FILES['Filedata']['type'], $types)) {
                $this->forward404();
            }
            if (!file_exists($targetPath)) {
                mkdir(str_replace('//', '/', $targetPath), 0755, true);
            }
            move_uploaded_file($tempFile, $targetFile);
            str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
        } else {
            $this->forward404();
        }
        echo 'Success';
        exit;
    }

    public function executeFile_upload_party(sfWebRequest $request) {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $folder = $request->getParameter('folder');

            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $folder . '/';
            $filename = $request->getParameter('filename') . '.' . pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
            $targetFile = str_replace('//', '/', $targetPath) . $filename;

            if ($_FILES['Filedata']['size'] > sfConfig::get('party_logo_size')) {
                $this->forward404();
            }

            /* foreach(glob($targetPath.'*.*') as $v){
              unlink($v);
              } */

            $types = array('image/pjpeg', 'image/jpeg', 'image/gif', 'image/png', 'application/octet-stream');
            if (!in_array($_FILES['Filedata']['type'], $types)) {
                $this->forward404();
            }

            if (!file_exists($targetPath)) {
                mkdir(str_replace('//', '/', $targetPath), 0755, true);
            }
            move_uploaded_file($tempFile, $targetFile);
            str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
            echo $filename;
        } else {
            $this->forward404();
        }
        exit;
    }

    public function executeFile_upload_post(sfWebRequest $request) {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $folder = $request->getParameter('folder');

            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $folder . '/';
            $filename = $request->getParameter('filename') . '.' . pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
            $targetFile = str_replace('//', '/', $targetPath) . $filename;

            if ($_FILES['Filedata']['size'] > sfConfig::get('post_photo_size')) {
                $this->forward404();
            }

            /* foreach(glob($targetPath.'*.*') as $v){
              unlink($v);
              } */

            $types = array('image/pjpeg', 'image/jpeg', 'image/gif', 'image/png', 'application/octet-stream');
            if (!in_array($_FILES['Filedata']['type'], $types)) {
                $this->forward404();
            }

            if (!file_exists($targetPath)) {
                mkdir(str_replace('//', '/', $targetPath), 0755, true);
            }
            move_uploaded_file($tempFile, $targetFile);
            str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
            echo $filename;
        } else {
            $this->forward404();
        }
        exit;
    }

    public function executeImage_from_external_url(sfWebRequest $request) {
        $this->forward404Unless($this->imageUrl = $request->getParameter('image_url'));

        $img = new sfImage($this->imageUrl);
        $response = $this->getResponse();
        $response->setContentType($img->getMIMEType());
        $img->resize(260, 450);
        $response->setContent($img);
        return sfView::NONE;
    }

}