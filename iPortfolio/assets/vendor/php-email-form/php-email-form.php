<?php

/**
 * PHP Email Form Class
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */
class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $headers;
    public $heading;
    public $message_text;
    public $ajax;
    public $message_sent_ok;
    public $mail_body;

    public $smtp;
    public $from;
    public $cc;
    public $bcc;

    public $mailpath;
    public $line_break;

    public $attachment_dir;
    public $attachment_list;

    public $invalid_to_email;
    public $invalid_from_name;
    public $invalid_from_email;
    public $invalid_subject;
    public $short;
    public $ajax_error;
    public $recaptcha_error;
    public $recaptcha_response;
    public $recaptcha_secret_key;
    public $honeypot;

    public function __construct()
    {
        $this->to = '';
        $this->from_name = '';
        $this->from_email = '';
        $this->subject = '';

        $this->headers = '';
        $this->heading = '';
        $this->message_text = '';
        $this->ajax = false;
        $this->message_sent_ok = '';

        $this->smtp = array();
        $this->from = '';
        $this->cc = array();
        $this->bcc = array();

        $this->mailpath = "/usr/sbin/sendmail";
        $this->line_break = "\r\n";

        $this->attachment_dir = "";
        $this->attachment_list = array();

        $this->invalid_to_email = 'Email to (receiving email address) is empty or invalid!';
        $this->invalid_from_name = 'From Name is empty!';
        $this->invalid_from_email = 'Email from: is empty or invalid!';
        $this->invalid_subject = 'Subject is too short or empty!';
        $this->short = 'is too short or empty!';
        $this->ajax_error = 'Sorry, the request should be an Ajax POST';
        $this->recaptcha_error = 'Please check the the reCAPTCHA box.';
        $this->recaptcha_response = '';
        $this->recaptcha_secret_key = '';
        $this->honeypot = '';
    }

    public function add_attachment($attachment_path)
    {
        $this->attachment_list[] = $attachment_path;
    }

    public function add_attachments($attachment_paths)
    {
        foreach ($attachment_paths as $attachment_path) {
            $this->add_attachment($attachment_path);
        }
    }

    public function add_message($message_text, $label = '', $min_length = 0)
    {
        $this->message_text .= ( ! empty($label) ? "<strong>{$label}</strong>: " : '' ) . $message_text . $this->line_break . $this->line_break;
        if (! empty($min_length) && strlen($message_text) < $min_length) {
            $this->invalid_messages[] = "{$label} {$this->short}";
        }
    }

    public function send()
    {
        $this->check_data();
        if ($this->is_valid_data) {
            $this->prepare_body();
            $this->is_mail_sent = $this->send_email();
            $this->response_status = $this->is_mail_sent ? 'OK' : 'Failed';
        } else {
            $this->response_status = implode("<br>\r\n", $this->invalid_messages);
        }

        return $this->response_status;
    }

    // ... (The rest of the code is omitted for brevity)
}