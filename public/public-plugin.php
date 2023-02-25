<?php
// category short code

class Public_PLUGIN{

   public $conn;

    public function __construct()
    {
        add_shortcode("from-submit-short-code",array($this,"from_submit_short_code_page"));
        add_action("wp_enqueue_scripts",array($this,"public_plugin_enqueue_scripts"));
        
    }

    public function public_plugin_enqueue_scripts(){
        
      
         
        wp_enqueue_style( "public-from-plugin-style",plugin_dir_url(__FILE__).'assets/css/public-plugin-style.css', array(),PLUGIN_VERSION, 'all' );
        
        wp_enqueue_script( "public-from-plugin-validation",plugin_dir_url(__FILE__).'assets/js/public-plugin-form-validation.js', array('jquery'),PLUGIN_VERSION, true);
        wp_enqueue_script( "public-from-plugin-price",plugin_dir_url(__FILE__).'assets/js/public-plugin-price-cal.js', array('jquery'),PLUGIN_VERSION, true);
        wp_enqueue_script( "public-from-plugin-script",plugin_dir_url(__FILE__).'assets/js/public-plugin-script.js', array('jquery'),PLUGIN_VERSION, true);
    
    }

    public function from_submit_short_code_page(){
        global $wpdb;
      
        if ( isset( $_POST['submit'] ) ) {
            $newspaper = sanitize_text_field( $_POST['newspaper'] );
            $txt_name = sanitize_text_field( $_POST['txt_name'] );
            $org_name = sanitize_text_field( $_POST['org_name'] );
            $txt_phone = sanitize_text_field( $_POST['txt_phone'] );
            $txt_email = sanitize_email( $_POST['txt_email'] );
            $datepicker = sanitize_text_field( $_POST['datepicker'] );
            $ad_title = sanitize_text_field( $_POST['ad_title'] );
            $message = sanitize_text_field( $_POST['message'] );
            $price = sanitize_text_field( $_POST['price'] );
          

            // Handle image upload
            if ( ! empty( $_FILES['attachment']['name'] ) ) {
                $uploaded_image = wp_upload_bits( $_FILES['attachment']['name'], null, file_get_contents( $_FILES['attachment']['tmp_name'] ) );
                if ( isset( $uploaded_image['error'] ) && $uploaded_image['error'] ) {
                wp_die( 'Error uploading image' );
                }
                $attachment = $uploaded_image['url'];
            } else {
                $attachment = '';
            }
            
            $wpdb->insert(
                'wp_custom_from_data_show_all',
                array(
                'newspaper' => $newspaper,
                'txt_name' => $txt_name,
                'org_name' => $org_name,
                'txt_phone' => $txt_phone,
                'txt_email' => $txt_email,
                'datepicker' => $datepicker,
                'ad_title' => $ad_title,
                'message' => $message,
                'price' => $price,
                'attachment' => $attachment,
                ),
            );
            
           
        }

        ob_start();
  
        ?>
        
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel='stylesheet'
        href='//cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css'>

    <script src='//www.google.com/recaptcha/api.js'></script>
    
    <section class="section section_form">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="POST" name="frm_contact" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 form-group row-fluid">
                                <h3><?php if(isset($dataget)){echo "Submit done";} ?></h3>
                                <h3>শ্রেণীভুক্ত বিজ্ঞাপন</h3>
                                <label for="select_newspaper">পত্রিকা বাছাই করুন</label>
                                <select class="form-control form-control-lg news_portal" id="select_newspaper"
                                    data-live-search="true" name="newspaper">
                                    <option int_price="1450" min_word="15" per_word="60" max_word="40" vat_price="15"
                                        value="প্রথম আলো">প্রথম আলো</optiion>
                                    <option int_price="750" min_word="16" per_word="40" max_word="50" vat_price="15"
                                        value="ইত্তেফাক">ইত্তেফাক</option>
                                    <option int_price="950" min_word="16" per_word="50" max_word="50" vat_price="15"
                                        value="নিউজ টুডে">নিউজ টুডে</option>
                                    <option int_price="650" min_word="24" per_word="30" max_word="60" vat_price="15"
                                        value="নিউ নেশন">নিউ নেশন</option>
                                    <option int_price="550" min_word="15" per_word="25" max_word="60" vat_price="15"
                                        value="যুগান্তর">যুগান্তর</option>
                                    <option int_price="550" min_word="20" per_word="25" max_word="40" vat_price="15"
                                        value="কালের কন্ঠ">কালের কন্ঠ</option>
                                    <option int_price="550" min_word="20" per_word="25" max_word="60" vat_price="15"
                                        value="জনকন্ঠ">জনকন্ঠ</option>
                                    <option int_price="450" min_word="20" per_word="20" max_word="80" vat_price="15"
                                        value="সমকাল">সমকাল</option>
                                    <option int_price="450" min_word="20" per_word="15" max_word="60" vat_price="15"
                                        value="আমাদের সময়">আমাদের সময়</option>
                                    <option int_price="450" min_word="16" per_word="20" max_word="40" vat_price="15"
                                        value="মানবজমিন">মানবজমিন</option>
                                    <option int_price="450" min_word="30" per_word="20" max_word="100" vat_price="15"
                                        value="যায়যায়দিন">যায়যায়দিন</option>
                                    <option int_price="350" min_word="20" per_word="20" max_word="100" vat_price="15"
                                        value="নয়া দিগন্ত">নয়া দিগন্ত</option>
                                    <option int_price="350" min_word="20" per_word="20" max_word="60" vat_price="15"
                                        value="ইনকিলাব">ইনকিলাব</option>
                                    <option int_price="500" min_word="20" per_word="25" max_word="60" vat_price="15"
                                        value="ভোরের কাগজ">ভোরের কাগজ</option>
                                    <option int_price="1150" min_word="20" per_word="40" max_word="50" vat_price="15"
                                        value="বাংলাদেশ প্রতিদিন">বাংলাদেশ প্রতিদিন</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <input type="text" id="website" name="website" />
                            <div class="col-md-12 form-group">
                                <label for="name">নাম</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="txt_name">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="org_name">প্রতিষ্ঠানের নাম</label>
                                <input type="text" class="form-control form-control-lg" id="org_name" name="org_name"
                                    placeholder="প্রতিষ্ঠান যদি থাকে, তবে পূরণ করুন">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="phone">ফোন *</label>
                                <input type="number" id="phone" class="form-control form-control-lg" name="txt_phone"
                                    placeholder="01XXXXXXXXX">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="email">ইমেইল</label>
                                <input type="email" id="email" class="form-control form-control-lg" name="txt_email"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="datepicker">যে তারিখে বিজ্ঞাপন প্রকাশ করতে চান </label>
                                <input type="text" id="datepicker" class="form-control form-control-lg"
                                    name="datepicker" placeholder="Select a date">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group row-fluid">
                                <label for="ad_title">বিজ্ঞাপনের শিরোনাম</label>
                                <select class="form-control form-control-lg" id="ad_title" data-live-search="true"
                                    name="ad_title"
                                    onchange="if (!window.__cfRLUnblockHandlers) return false; SelectTitle(this.value);"
                                    data-cf-modified-32aa1917021f6c59968fa1b5-="">
                                    <option value="বাড়ি ভাড়া">বাড়ি ভাড়া</option>
                                    <option value="ভাড়া">ভাড়া</option>
                                    <option value="ক্রয়">ক্রয়</optiion>
                                    <option value="বিক্রয়">বিক্রয়</optiion>
                                    <option value="ফ্ল্যাট বিক্রয়">ফ্ল্যাট বিক্রয়</optiion>
                                    <option value="গাড়ি বিক্রয়">গাড়ি বিক্রয়</option>
                                    <option value="জমি বিক্রয়">জমি বিক্রয়</option>
                                    <option value="পাত্র/পাত্রী চাই">পাত্র/পাত্রী চাই</option>
                                    <option value="টিউটর দিচ্ছি/নিচ্ছি">টিউটর দিচ্ছি/নিচ্ছি</option>
                                    <option value="পড়াইতে চাই">পড়াইতে চাই</option>
                                    <option value="হারানো বিজ্ঞপ্তি">হারানো বিজ্ঞপ্তি</option>
                                    <option value="আবশ্যক">আবশ্যক</option>
                                    <option value="এফিডেভিট/সংশোধনী">এফিডেভিট/সংশোধনী</option>
                                    <option value="বিবিধ">বিবিধ</option>
                                    <option value="নিখোঁজ সংবাদ">নিখোঁজ সংবাদ</option>
                                    <option value="সাহায্যের আবেদন">সাহায্যের আবেদন</option>
                                    <option value="শোক সংবাদ">শোক সংবাদ</option>
                                    <option value="কুলখানি">কুলখানি</option>
                                    <option value="মৃত্যুবার্ষিকী">মৃত্যুবার্ষিকী</option>
                                    <option value="মেধাবী মুখ">মেধাবী মুখ</option>
                                    <option value="জন্মদিনের শুভেচ্ছা">জন্মদিনের শুভেচ্ছা</option>
                                    <option value="অন্যান্য">অন্যান্য</option>
                                </select>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="message">শ্রেণীভুক্ত বিজ্ঞাপনটি লিখুন</label>
                                <textarea name="message" id="message" class="form-control form-control-lg" cols="30"
                                    rows="8" placeholder="শব্দ সংখ্যা সীমিত"> </textarea>
                                <br>
                                মোট শব্দ সংখ্যা: <span id="display_count">0</span> শব্দ । অবশিষ্ট শব্দ: <span
                                    id="word_left">0</span>
                            </div>
                        </div>
                        <p style="background-color:#df294f; color:#fff; padding:10px;">শ্রেণিভুক্ত বিজ্ঞাপনে কোনো
                            দর্শনীয় শিরোনাম দেওয়া হয় না । এ জাতীয় বিজ্ঞাপনের মূল্য প্রথম <code style="padding:5px"
                                class="min_word"></code> শব্দের জন্য মোট <code style="padding:5px"
                                class="total_amt"></code> টাকা এবং পরবর্তী প্রতি শব্দের জন্য <code style="padding:5px"
                                class="per_word"></code> টাকা। বিজ্ঞাপন মুল্যের সাথে অতিরিক্ত <code
                                style="padding:5px">15%</code> ভ্যাট সংযোজিত হবে। শ্রেণিভুক্ত বিজ্ঞাপন সর্বোচ্চ <code
                                style="padding:5px" class="max_word"></code> শব্দের মধ্যে হতে হবে। </p>
                        <div class="row">
                            <div class="col-md-12 form-group" style="display:none">
                                <label for="price_ui">বিজ্ঞাপনের মূল্য</label>
                                <input type="number" id="price" class="form-control form-control-lg" name="price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="price">বিজ্ঞাপনের মূল্য</label>
                                <input type="number" id="price_ui" class="form-control form-control-lg" name="price_ui"
                                    disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="myfile">আপনার ফাইল সিলেক্ট করুন</label>
                                <input type="file" id="myfile" class="form-control form-control-lg" name="attachment"
                                    placeholder="Select Your File">
                            </div>
                        </div>













                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="সাবমিট করুন" class="btn btn-primary btn-lg btn-common-color"
                                    name="submit" id="submit"
                                   >
                            </div>
                        </div>
                        <p
                            style="background-color:#df294f; color:#fff; padding:20px; text-align:center; font-weight:700">
                            বিজ্ঞাপনের প্রদত্ত মুল্যটি বিকাশ করুনঃ <code
                                style="padding:5px; font-weight:700">01779870454</code></p>
                        <h5 class="alert"></h5>
                    </form>
                </div>

            </div>
    </section>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script data-cfasync="false" src="//cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
    <script src='//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

    </script>












    <script>
        function getQueryStringValue(key) {
            return decodeURIComponent(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURIComponent(key)
                .replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
        }


        // code for int datepicker
        jQuery(document).ready(function($) {

            var dt = new Date();
            dt.setDate(dt.getDate() + 1);

            $("#datepicker").datepicker({
                minDate: dt,
                dateFormat: 'dd-M-yy',
            });

            // show curent avaible date 
            $("#datepicker").datepicker("setDate", dt);

            var myParam = location.search.split('msg=')[1];
            if (getQueryStringValue("msg") == "ok") {
                swal({
                    title: '<span style="color:#fff">ধন্যবাদ! আপনার শ্রেণীভুক্ত বিজ্ঞাপনটি সফলভাবে সাবমিশন করা হয়েছে!!! পরবর্তী নির্দেশনার জন্য অনুগ্রহ করে আপনার মেইলটি চেক করুন।</span>',

                    background: '#DF274D',
                })
            }
        });


        window.onload = function () {
            var $recaptcha = document.querySelector('#g-recaptcha-response');

            if ($recaptcha) {
                $recaptcha.setAttribute("required", "required");
            }
        }
    </script>
    <script>
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
    </script>
    <script>
        function SelectTitle(val) {
            var element = document.getElementById('chosen_title');
            if (val == 'অন্যান্য')
                element.style.display = 'block';
            else
                element.style.display = 'none';
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function (event) {


            var acc = document.getElementsByClassName("accordion");
            var panel = document.getElementsByClassName('panel');

            for (var i = 0; i < acc.length; i++) {
                acc[i].onclick = function () {
                    var setClasses = !this.classList.contains('active');
                    setClass(acc, 'active', 'remove');
                    setClass(panel, 'show', 'remove');

                    if (setClasses) {
                        this.classList.toggle("active");
                        this.nextElementSibling.classList.toggle("show");
                    }
                }
            }

            function setClass(els, className, fnName) {
                for (var i = 0; i < els.length; i++) {
                    els[i].classList[fnName](className);
                }
            }

        });
    </script>
    <script>
        function successPopup(id) {
            var txt;
            if (confirm("Please confirm")) {
                txt = "Thank you for your submission";
            } else {
                txt = "";
            }
            document.getElementById(id).innerHTML = txt;
        }
    </script>
    <script src="https://cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"></script>

        <?php

        echo ob_get_clean();

    }

}



$obj = new Public_PLUGIN();
