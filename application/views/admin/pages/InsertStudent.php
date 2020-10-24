<?php include(APPPATH.'views/admin/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include(APPPATH.'views/admin/head.php'); ?>
</head>

<body>
<div class="wrapper">

  <!-- Navbar -->
  <?php include(APPPATH.'views/admin/header.php'); ?>
  <!-- /.navbar -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?>
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student Details"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Student Details";}?></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
        <form method="post" enctype="multipart/form-data" id="InsertStudents">
            <div class="col-md-6">
              <!-- /.form-group -->
            </div>
            
            <div class="col-md-6">
              <div class="img-top">
            <img class="img-responsive" id="blah" alt="" src="<?php echo base_url('assets/dist/images/studenticon.png');?>" height="150" width="150" />
                    <div class=''>
                        <label class="upimage"> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Upload Image";}?>
                        <input type="file" name="StudentImage" id="imgInp"  class="form-control custom-input-form-control" >
                        </label>
                    </div> <!-- text-right / end -->
              </div>
              
            </div>
            <!-- Start Of Email verify Para -->
            <div class="col-md-12">
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <p id="EmailPara"></p>
              </div>
            </div>
            <!-- End Of Email verify Para -->
            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?> <span class="required_star"> *</span></label>
                <input type="text" name="StudentName" id="StudentName" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Religion"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Religion";}?> <span class="required_star"> *</span></label>
                <select id="Religion" class="form-control select2">
                  <option value="">Select Religion</option>
                    <option value="Islam"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Islam"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Islam";}?></option>
                    <option value="Hindu"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Hindu"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Hindu";}?></option>
                    <option value="Hindu"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Christian"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Christian";}?></option>
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            
            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student GR No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Student GR No";}?> <span class="required_star"> *</span></label>
                <input type="text" name="StudentGR" id="StudentGR" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student GR No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Student GR No";}?>" class="form-control" value="<?php echo 'GR_'.$LastId; ?>">
              </div>
              
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?> <span class="required_star"> *</span></label>
                <select id="ClassId" class="form-control select2">
                  <option value="">Select Class</option>
                  <?php if(!empty($ClassList)){ foreach($ClassList as $CLSLI){ ?>
                    <option value="<?php echo $CLSLI->ClassId ?>"><?php echo $CLSLI->ClassName ?></option>
                  <?php }} ?>
                </select>
              </div>
              <!-- /.form-group -->
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Section"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Section";}?> <span class="required_star"> *</span></label>
                <select id="SectionId" name="Section" class="form-control select2">
                      <option value="">Select Section</option>
                    <?php if(!empty($SectionList)){ foreach($SectionList as $SELIS){?>
                    
                      <option value="<?php if(!empty($SELIS->SectionId)){ echo $SELIS->SectionId; } ?>"><?php if(!empty($SELIS->SectionName)){ echo $SELIS->SectionName; } ?></option>

                    <?php }} ?>
                    
                  </select>
              </div>
              
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Document"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Document";}?></label>
                <input type="file" name="Document" id="Document" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Document"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Document";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
            </div>

            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "SMS Cell No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "SMS Cell No";}?> </label>
                <input type="text" name="PhoneNumber" id="PhoneNumber" data-mask="0000-0000000" value="<?php if(!empty($EmployeeData)){ echo $EmployeeData['PhoneNumber']; } ?>"  placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "0300-0000000"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "0300-0000000";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
              
              <!-- /.form-group -->
            </div>

            <div class="col-md-6">
              
              <!-- /.form-group -->
              <div class="form-group">
              <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date Of Birth"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date Of Birth";}?><span class="required_star"> *</span></label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="StudentBirth" class="form-control" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date Of Birth"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date Of Birth";}?>" id="datepicker">
                  </div>
                  <!-- /.input group -->
                </select>
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">

              <!-- /.form-group -->
              <div class="form-group">
                 <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?> <span class="required_star"> *</span></label>
                <input type="text" name="Address" id="Address" value="" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?>" class="form-control"> 
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">

              <!-- /.form-group -->
              <div class="form-group">
                 <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?> <span class="required_star"> *</span></label>
                <input type="text" name="Fee" id="Fee" value="" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Fee"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Fee";}?>" class="form-control"> 
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                  <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Nationality"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Nationality";}?> <span class="required_star"> *</span></label>
                  <select id="nationality" name="nationality" class="form-control select2">
                      <option value="Afganistan">Afghanistan</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaijan">Azerbaijan</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrain">Bahrain</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Belgium">Belgium</option>
                      <option value="Belize">Belize</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermuda">Bermuda</option>
                      <option value="Bhutan">Bhutan</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bonaire">Bonaire</option>
                      <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                      <option value="Botswana">Botswana</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                      <option value="Brunei">Brunei</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Canary Islands">Canary Islands</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">Central African Republic</option>
                      <option value="Chad">Chad</option>
                      <option value="Channel Islands">Channel Islands</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos Island">Cocos Island</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cote DIvoire">Cote DIvoire</option>
                      <option value="Croatia">Croatia</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Curaco">Curacao</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">Dominican Republic</option>
                      <option value="East Timor">East Timor</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">Equatorial Guinea</option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands">Falkland Islands</option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Ter">French Southern Ter</option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Great Britain">Great Britain</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Hawaii">Hawaii</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="India">India</option>
                      <option value="Iran">Iran</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Isle of Man">Isle of Man</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Korea North">Korea North</option>
                      <option value="Korea Sout">Korea South</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Laos">Laos</option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libya">Libya</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macau">Macau</option>
                      <option value="Macedonia">Macedonia</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Midway Islands">Midway Islands</option>
                      <option value="Moldova">Moldova</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Nambia">Nambia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherland Antilles">Netherland Antilles</option>
                      <option value="Netherlands">Netherlands (Holland, Europe)</option>
                      <option value="Nevis">Nevis</option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau Island">Palau Island</option>
                      <option value="Palestine">Palestine</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Phillipines">Philippines</option>
                      <option value="Pitcairn Island">Pitcairn Island</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Republic of Montenegro">Republic of Montenegro</option>
                      <option value="Republic of Serbia">Republic of Serbia</option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russia">Russia</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="St Barthelemy">St Barthelemy</option>
                      <option value="St Eustatius">St Eustatius</option>
                      <option value="St Helena">St Helena</option>
                      <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                      <option value="St Lucia">St Lucia</option>
                      <option value="St Maarten">St Maarten</option>
                      <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                      <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                      <option value="Saipan">Saipan</option>
                      <option value="Samoa">Samoa</option>
                      <option value="Samoa American">Samoa American</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra Leone">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">Slovakia</option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="Spain">Spain</option>
                      <option value="Sri Lanka">Sri Lanka</option>
                      <option value="Sudan">Sudan</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Syria">Syria</option>
                      <option value="Tahiti">Tahiti</option>
                      <option value="Taiwan">Taiwan</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania">Tanzania</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Erimates">United Arab Emirates</option>
                      <option value="United States of America">United States of America</option>
                      <option value="Uraguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Vatican City State">Vatican City State</option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Vietnam">Vietnam</option>
                      <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                      <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                      <option value="Wake Island">Wake Island</option>
                      <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                      <option value="Yemen">Yemen</option>
                      <option value="Zaire">Zaire</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>
              </div>
            </div>
            <div class="col-md-6">
              <!-- /.form-group -->
              <!-- radio -->
              <div class="form-group" style="margin-top:1%;">
              <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gender"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Gender";}?> <span class="required_star"> *</span></label><br>
                <label class="gender"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Male"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Male";}?>
                  <input type="radio" name="Gender" id="Gender" value="Male" class="flat-red" checked>
                </label>
                <label class="gender"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Female"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Female";}?>
                  <input type="radio" name="Gender" id="Gender1" value="Female" class="flat-red">
                </label>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->

            <div class="col-md-12">
              <!-- /.form-group -->
              <!-- radio -->
              <div class="form-group">
              <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Does child have any medical or psychological conditions?"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Does child have any medical or psychological conditions?";}?> <span class="required_star"> *</span></label><br>
                <textarea class="form-control" id="childMedical" rows="4" cols="50" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Does child have any medical or psychological conditions?"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Does child have any medical or psychological conditions?";}?>"></textarea>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12" style="margin-top:2%;">
            <h4><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Family Information"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Family Information";}?></h4>
            </div>
            <!-- /.col -->
            <div class="col-md-6" style="margin-top:1%;">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?> <span class="required_star"> *</span></label>
                <input type="text" name="FatherName" id="FatherName"  placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CNIC"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CNIC";}?> <span class="required_star"> *</span></label>
                <input type="text" name="FatherCNIC" id="FatherCNIC" data-mask="00000-0000000-0" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "FatherCNIC"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "FatherCNIC";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-6" style="margin-top:1%;">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Mother Name";}?> <span class="required_star"> *</span></label>
                <input type="text" name="MotherName" id="MotherName"  placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Mother Name";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CNIC"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CNIC";}?> <span class="required_star"> *</span></label>
                <input type="text" name="MotherCNIC" id="MotherCNIC" data-mask="00000-0000000-0" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "MotherCNIC"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "MotherCNIC";}?>" class="form-control">
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Cell No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Cell No";}?> <span class="required_star"> *</span></label>
                <input type="text" name="FatherPhone" id="FatherPhone" data-mask="0000-0000000" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>" class="form-control">
              </div>

              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Occupation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Occupation";}?> <span class="required_star"> *</span></label>
                <input type="text" name="FatherOccupation" id="FatherOccupation" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Occupation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Occupation";}?>" class="form-control">
              </div>
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Cell No"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Mother Cell No";}?> <span class="required_star"> *</span></label>
                <input type="text" name="MotherPhone" id="MotherPhone" data-mask="0000-0000000" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>" class="form-control">
              </div>

              <div class="form-group">
                <label><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Occupation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Mother Occupation";}?> <span class="required_star"> *</span></label>
                <input type="text" name="MotherOccupation" id="MotherOccupation" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Mother Occupation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Mother Occupation";}?>" class="form-control">
              </div>
            </div>
            <!-- /.col -->
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" id="EmployeeSubmit" style="margin-top:8%;" onclick="InsertStudent()" class="btn btn-info pull-right"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?></button>
              </div>
              <!-- /.box-footer -->
          </form>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

    </div>
</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>
<script>

// $(function(){
//   $('#PhoneNumber').usPhoneFormat({
//     format:'xxxx-xxxxxxx'
//   });
// });


function readURL(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#blah').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

$("#imgInp").change(function() {
readURL(this);
});
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    });
    
  });
</script>

<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })


/**************** Insert Staff Field Using Ajax *************/
function InsertStudent() {
    
    var StudentName = document.getElementById('StudentName').value;
    var Religion = document.getElementById('Religion').value;
    var StudentGR = document.getElementById('StudentGR').value;
    var ClassId = document.getElementById('ClassId').value;
    var SectionId = document.getElementById('SectionId').value;
    var nationality = document.getElementById('nationality').value;
    var PhoneNumber = document.getElementById('PhoneNumber').value;
    var BirthDate = document.getElementById('datepicker').value;
    var Address = document.getElementById('Address').value;
    var childMedical = document.getElementById('childMedical').value;
    var FatherName = document.getElementById('FatherName').value;
    var FatherCNIC = document.getElementById('FatherCNIC').value;
    var MotherName = document.getElementById('MotherName').value;
    var MotherCNIC = document.getElementById('MotherCNIC').value;
    var FatherPhone = document.getElementById('FatherPhone').value;
    var FatherOccupation = document.getElementById('FatherOccupation').value;
    var MotherPhone = document.getElementById('MotherPhone').value;
    var MotherOccupation = document.getElementById('MotherOccupation').value;
    var Fee = document.getElementById('Fee').value;
    
    if(StudentName == ""){
      Snackbar.show({pos: 'top-right',text: "Student Name Required"});
    }else if(Religion == ""){
      Snackbar.show({pos: 'top-right',text: "Religion Required"});
    }else if(StudentGR == ""){
      Snackbar.show({pos: 'top-right',text: "StudentGR Required"});
    }else if(ClassId == ""){
      Snackbar.show({pos: 'top-right',text: "Class Required"});
    }else if(SectionId == ""){
      Snackbar.show({pos: 'top-right',text: "Class Required"});
    }else if(nationality == ""){
      Snackbar.show({pos: 'top-right',text: "Nationality Required"});
    }else if(BirthDate == ""){
      Snackbar.show({pos: 'top-right',text: "BirthDate Required"});
    }else if(Address == ""){
      Snackbar.show({pos: 'top-right',text: "Address Required"});
    }else if(Fee == ""){
      Snackbar.show({pos: 'top-right',text: "Fee Required"});
    }else if(childMedical == ""){
      Snackbar.show({pos: 'top-right',text: "childMedical Required"});
    }else if(FatherName == ""){
      Snackbar.show({pos: 'top-right',text: "FatherName Required"});
    }else if(FatherCNIC == ""){
      Snackbar.show({pos: 'top-right',text: "FatherCNIC Required"});
    }else if(MotherName == ""){
      Snackbar.show({pos: 'top-right',text: "MotherName Required"});
    }else if(MotherCNIC == ""){
      Snackbar.show({pos: 'top-right',text: "MotherCNIC Required"});
    }else if(FatherPhone == ""){
      Snackbar.show({pos: 'top-right',text: "FatherPhone Required"});
    }else if(FatherOccupation == ""){
      Snackbar.show({pos: 'top-right',text: "FatherOccupation Required"});
    }else if(MotherPhone == ""){
      Snackbar.show({pos: 'top-right',text: "MotherPhone Required"});
    }else if(MotherOccupation == ""){
      Snackbar.show({pos: 'top-right',text: "MotherOccupation Required"});
    }else{
      var form_data = new FormData();
          form_data.append("StudentImage", document.getElementById('imgInp').files[0]);
          form_data.append("StudentName", StudentName);
          form_data.append("Religion", Religion);
          form_data.append("StudentGR", StudentGR);
          form_data.append("ClassId", ClassId);
          form_data.append("SectionId", SectionId);
          form_data.append("nationality", nationality);
          form_data.append("PhoneNumber", PhoneNumber);
          form_data.append("BirthDate", BirthDate);
          form_data.append("Address", Address);
          form_data.append("Fee", Fee);
          form_data.append("childMedical", childMedical);
          form_data.append("FatherName", FatherName);
          form_data.append("FatherCNIC", FatherCNIC);
          form_data.append("MotherName", MotherName);
          form_data.append("MotherCNIC", MotherCNIC);
          form_data.append("FatherPhone", FatherPhone);
          form_data.append("FatherOccupation", FatherOccupation);
          form_data.append("MotherPhone", MotherPhone);
          form_data.append("MotherOccupation", MotherOccupation);
          form_data.append("Document", document.getElementById('Document').files[0]);

          if (document.getElementById('Gender').checked) {
            form_data.append("Gender", document.getElementById('Gender').value);
          }else if(document.getElementById('Gender1').checked){
            form_data.append("Gender", document.getElementById('Gender1').value);
          }
          $.ajax({
            url:"<?php echo base_url('Admin/InsertStudent/InsertData'); ?>",
            method:"POST",
            dataType: 'JSON',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success:function(InsertStudent)
            {
              if (InsertStudent.status == true) {
                Snackbar.show({pos: 'top-right',text:InsertStudent.message});
                setTimeout(function(){
                  location.reload();
                }, 3000);
                
              }else{
                Snackbar.show({pos: 'top-right',text:InsertStudent.message});
              }
            }
          });
    }

  } 
</script>
</body>
</html>