<?php

    function hasUploadedPhotos($inno_id)
    {
        $innovation_image = DB::table('innovation_images')
        ->where('inno_id','=',$inno_id)
        ->first();

        if($innovation_image){
            return true;
        }else{
            return false;
        }
    }

    function getploadedPhoto($inno_id)
    {
        $innovation_image = DB::table('innovation_images')
        ->where('inno_id','=',$inno_id)
        ->first();

       return $innovation_image->img_file;
    }


    function siteHit()
    {
        DB::table('sitehitusers')
        ->insert([
            'usrIP' => \Request::ip(),
            'usrDate' => \Carbon\Carbon::now()
        ]);

        $sitehit = DB::table('sitehits')
        ->whereDate('hitDate' ,'=', date("Y-m-d"))
        ->first();

        if($sitehit){
            DB::table('sitehits')
            ->where('hitID','=', $sitehit->hitID)
            ->increment("hitCount", 1);

        }else{
            DB::table('sitehits')
            ->insert([
                'hitDate' => date("Y-m-d"),
                'hitCount' => 1
            ]);
        }
    }

    function sendEmail($emailSubject,$emailContent,$emailTo)
    {
        session()->put('emailTo', $emailTo);
        session()->put('emailSubject', $emailSubject);

        Mail::raw($emailContent, function($message) {
            $message
                ->to(session()->get('emailTo'), 'GRIND User')
                ->subject(session()->get('emailSubject'));
            $message->from('mailer@infinitlms.com','GRIND');
        });
    }

    function generateuuid()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';

        for ($i = 0; $i < 32; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    function generateCode()
    {
        $characters = '0123456789';
        $string = '';

        for ($i = 0; $i < 5; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

    function generateDigitCode(){
        return rand(100000, 999999);
    }

    function unauthorize()
    {
        echo redirect('/logout');
        exit();
    }

    function setUserSessionVariables($user)
    {
        $usr_id = $user->usr_id;
        $usr_uuid = $user->usr_uuid;
        $typ_id = $user->typ_id;
        $usr_email = $user->usr_email;
        $usr_last_name = $user->usr_last_name;
        $usr_first_name = $user->usr_first_name;
        $usr_middle_name = $user->usr_middle_name;
        $usr_birth_date = $user->usr_birth_date;
        $usr_image_path = $user->usr_image_path;
        $usr_email_activation_code = $user->usr_email_activation_code;

        Session::put('usr_id', $usr_id);
        Session::put('usr_uuid', $usr_uuid);
        Session::put('typ_id', $typ_id);
        Session::put('usr_last_name', $usr_last_name);
        Session::put('usr_first_name', $usr_first_name);
        Session::put('usr_middle_name', $usr_middle_name);
        Session::put('usr_email', $usr_email);
        Session::put('usr_birth_date', $usr_birth_date);
        Session::put('usr_image_path', $usr_image_path);
        Session::put('usr_email_activation_code', $usr_email_activation_code);
        Session::put('usr_full_name', $usr_first_name . ' ' . $usr_middle_name . ' ' . $usr_last_name);

        recordLogin($usr_id);
    }

    function getUserName($usr_id)
    {
        $user = DB::table('users')
        ->where('usr_id','=',$usr_id)
        ->first();

        if($user){
            $last_name = $user->usr_last_name;
            $first_name = $user->usr_first_name;
            $display_name = $first_name .' ' . $last_name;
            return $display_name;
        }else{
            return '';
        }
    }

    function incrementUserLoginCounter($usr_email)
    {
        $user = DB::table('users')
        ->where('usr_email','=',$usr_email)
        ->increment('usr_invalid_login_count', 1);
    }

    function resetUserLoginCounter($usr_email)
    {
        $user = DB::table('users')
        ->where('usr_email','=',$usr_email)
        ->update([
            'usr_invalid_login_count' => '0'
        ]);
    }

    function generateNewsID()
    {
        $news = DB::table('news')->orderby('news_id','desc')->first();

        if($news){
            $code = $news->news_id + 1;
        }else{
            $code = 1;
        }

        return $code;
    }

    function generateActivityID()
    {
        $activities = DB::table('activities')->orderby('act_id','desc')->first();

        if($activities){
            $code = $activities->act_id + 1;
        }else{
            $code = 1;
        }

        return $code;
    }

    function generateArticleID()
    {
        $articles = DB::table('articles')->orderby('art_id','desc')->first();

        if($articles){
            $code = $articles->art_id + 1;
        }else{
            $code = 1;
        }

        return $code;
    }

    function recordLogin($usr_id)
    {
        $user = DB::table('logins')
        ->insert([
            'usr_id' => $usr_id,
            'log_date' => \Carbon\Carbon::now(),
            'log_ip' => \Request::ip(),
        ]);
    }

    function getAvatar($usr_id)
    {
        try{
            $users=DB::table('users')
            ->where('usr_id','=',$usr_id)
            ->first();

            if($users->usr_image_path <> ''){
                return 'images/avatars/' . $users->usr_image_path;
            }else{
                return 'images/avatar.png';
            }
        }catch (Exception $e){
            return 'images/avatar.png';
        }
    }
?>
