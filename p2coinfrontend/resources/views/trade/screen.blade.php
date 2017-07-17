@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <button data-toggle="collapse" data-target="#search_form" class="btn btn-success btn-green">Search</button>
        <div id="search_form" class="collapse currrency-green" style="border:1px solid grey;padding:20px;">
            <form class="form-horizontal" action="{{ route('storelistings') }}" method="post" style="">
                {{ csrf_field() }}
                <h3 class="h-title text-center">Search Listings</h3>
                <div class="form-group">
                    <label for="location">Amount</label>
                    <div>
                        <input class="numberinput form-control" id="con_amount" name="coin_amount" type="number"> 
                    </div>
                </div>
                <div class="form-group">
                    <label for="currency">Currency</label>
                    <div> 
                        <select class="select form-control" id="currency" name="currency">
                            <option value="AED">AED</option><option value="AFN">AFN</option><option value="ALL">ALL</option><option value="AMD">AMD</option><option value="ANG">ANG</option><option value="AOA">AOA</option><option value="ARS">ARS</option><option value="AUD">AUD</option><option value="AWG">AWG</option><option value="AZN">AZN</option><option value="BAM">BAM</option><option value="BBD">BBD</option><option value="BDT">BDT</option><option value="BGN">BGN</option><option value="BHD">BHD</option><option value="BIF">BIF</option><option value="BMD">BMD</option><option value="BND">BND</option><option value="BOB">BOB</option><option value="BRL">BRL</option><option value="BSD">BSD</option><option value="BTN">BTN</option><option value="BWP">BWP</option><option value="BYN">BYN</option><option value="BYR">BYR</option><option value="BZD">BZD</option><option value="CAD">CAD</option><option value="CDF">CDF</option><option value="CHF">CHF</option><option value="CLF">CLF</option><option value="CLP">CLP</option><option value="CNH">CNH</option><option value="CNY">CNY</option><option value="COP">COP</option><option value="CRC">CRC</option><option value="CUC">CUC</option><option value="CUP">CUP</option><option value="CVE">CVE</option><option value="CZK">CZK</option><option value="DJF">DJF</option><option value="DKK">DKK</option><option value="DOP">DOP</option><option value="DZD">DZD</option><option value="EEK">EEK</option><option value="EGP">EGP</option><option value="ERN">ERN</option><option value="ETB">ETB</option><option value="EUR">EUR</option><option value="FJD">FJD</option><option value="FKP">FKP</option><option value="GBP">GBP</option><option value="GEL">GEL</option><option value="GGP">GGP</option><option value="GHS">GHS</option><option value="GIP">GIP</option><option value="GMD">GMD</option><option value="GNF">GNF</option><option value="GTQ">GTQ</option><option value="GYD">GYD</option><option value="HKD">HKD</option><option value="HNL">HNL</option><option value="HRK">HRK</option><option value="HTG">HTG</option><option value="HUF">HUF</option><option value="IDR">IDR</option><option value="ILS">ILS</option><option value="IMP">IMP</option><option value="INR">INR</option><option value="IQD">IQD</option><option value="IRR">IRR</option><option value="ISK">ISK</option><option value="JEP">JEP</option><option value="JMD">JMD</option><option value="JOD">JOD</option><option value="JPY">JPY</option><option value="KES">KES</option><option value="KGS">KGS</option><option value="KHR">KHR</option><option value="KMF">KMF</option><option value="KPW">KPW</option><option value="KRW">KRW</option><option value="KWD">KWD</option><option value="KYD">KYD</option><option value="KZT">KZT</option><option value="LAK">LAK</option><option value="LBP">LBP</option><option value="LKR">LKR</option><option value="LRD">LRD</option><option value="LSL">LSL</option><option value="LTL">LTL</option><option value="LVL">LVL</option><option value="LYD">LYD</option><option value="MAD">MAD</option><option value="MDL">MDL</option><option value="MGA">MGA</option><option value="MKD">MKD</option><option value="MMK">MMK</option><option value="MNT">MNT</option><option value="MOP">MOP</option><option value="MRO">MRO</option><option value="MTL">MTL</option><option value="MUR">MUR</option><option value="MVR">MVR</option><option value="MWK">MWK</option><option value="MXN">MXN</option><option value="MYR">MYR</option><option value="MZN">MZN</option><option value="NAD">NAD</option><option value="NGN">NGN</option><option value="NIO">NIO</option><option value="NOK">NOK</option><option value="NPR">NPR</option><option value="NZD">NZD</option><option value="OMR">OMR</option><option value="PAB">PAB</option><option value="PEN">PEN</option><option value="PGK">PGK</option><option value="PHP">PHP</option><option value="PKR">PKR</option><option value="PLN">PLN</option><option value="PYG">PYG</option><option value="QAR">QAR</option><option value="RON">RON</option><option value="RSD">RSD</option><option value="RUB">RUB</option><option value="RWF">RWF</option><option value="SAR">SAR</option><option value="SBD">SBD</option><option value="SCR">SCR</option><option value="SDG">SDG</option><option value="SEK">SEK</option><option value="SGD">SGD</option><option value="SHP">SHP</option><option value="SLL">SLL</option><option value="SOS">SOS</option><option value="SRD">SRD</option><option value="SSP">SSP</option><option value="STD">STD</option><option value="SVC">SVC</option><option value="SYP">SYP</option><option value="SZL">SZL</option><option value="THB">THB</option><option value="TJS">TJS</option><option value="TMT">TMT</option><option value="TND">TND</option><option value="TOP">TOP</option><option value="TRY">TRY</option><option value="TTD">TTD</option><option value="TWD">TWD</option><option value="TZS">TZS</option><option value="UAH">UAH</option><option value="UGX">UGX</option>
                            <option value="USD" selected>USD</option><option value="UYU">UYU</option><option value="UZS">UZS</option><option value="VEF">VEF</option><option value="VND">VND</option><option value="VUV">VUV</option><option value="WST">WST</option><option value="XAF">XAF</option><option value="XAG">XAG</option><option value="XAR">XAR</option><option value="XAU">XAU</option><option value="XCD">XCD</option><option value="XDR">XDR</option><option value="XOF">XOF</option><option value="XPD">XPD</option><option value="XPF">XPF</option><option value="XPT">XPT</option><option value="YER">YER</option><option value="ZAR">ZAR</option><option value="ZMK">ZMK</option><option value="ZMW">ZMW</option><option value="ZWL">ZWL</option>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <label for="location">Country</label>
                    <div>
                        <select id="location" name="location" class="form-control">
                            <option value="  " selected>(please select a country)</option>
                            <option value="--">none</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia and Herzegowina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, the Democratic Republic of the</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote d'Ivoire</option>
                            <option value="HR">Croatia (Hrvatska)</option>
                            <option value="CU">Cuba</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="TP">East Timor</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="FX">France, Metropolitan</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard and Mc Donald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran (Islamic Republic of)</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macau</option>
                            <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="KN">Saint Kitts and Nevis</option> 
                            <option value="LC">Saint LUCIA</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option> 
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SK">Slovakia (Slovak Republic)</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SH">St. Helena</option>
                            <option value="PM">St. Pierre and Miquelon</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen Islands</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands (British)</option>
                            <option value="VI">Virgin Islands (U.S.)</option>
                            <option value="WF">Wallis and Futuna Islands</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="YU">Yugoslavia</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="payment_method">Payment Method</label>
                    <select class="form-control" id="payment_method" name="payment_method">
                        <option value="cash_deposit">Cash Deposit</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="cash_in_person">Cash in Person</option>
                        <option value="cash_by_email">Cash by Email</option>
                        <option value="moneygram">Moneygram</option>
                        <option value="western_union">Western Union</option>
                        <option value="other">Other...</option>
                    </select>
                    
                </div>
                
                <div class="form-group "> 
                    <div class="col-sm-offset-9 col-sm-3">
                    <button type="search" class="btn btn-success btn-green">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="col-md-6 col-md-offset-3">
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="h-title text-center title-border-bottom">Buy Cryptocurrencies in {{ $location }}</h3>
        </div>
        <div class="col-md-12 title-content-body">
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                        <tr>
                            <th class="menu-caption">Vendor</th>
                            <th class="menu-caption">Payment Method</th>
                            <th class="menu-caption">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn-success btn-green">See More</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="h-title text-center title-border-bottom">Sell Cryptocurrencies in {{ $location }}</h3>
        </div>
        <div class="col-md-12 title-content-body">
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                        <tr>
                            <th class="menu-caption">Vendor</th>
                            <th class="menu-caption">Payment Method</th>
                            <th class="menu-caption">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <button class="btn btn-success btn-green">See More</button>
        </div>
    </div>
</div>
@endsection