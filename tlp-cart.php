<?php
/*
 *Template Name: Cart Page
 */
get_header();
?>

<!-- Header -->
<section id="menu_list">
  <div class="container">
    <div class="row">
      <ul>
        <li>Home <i class="fa-solid fa-arrow-right"></i></li>
        <li>Product</li>
      </ul>
    </div>
  </div>
</section>
<?php
$counts = [];
if (isset($_COOKIE['list-product'])) {
  ?>
  <div id="cartPage" class="container">
    <table style="margin: 0px auto;">
      <tbody>
        <?php
        $list_products = $_COOKIE['list-product'];
        $list_products = stripslashes($list_products);
        $products = json_decode($list_products, true);

        $values = array_column($products, 'id');

        $counts = array_count_values($values);

        if (is_array($products)) {
          ?>
          <tr>
            <th>Product Details</th>
            <th>Qty</th>
            <th>Del</th>
          </tr>
          <?php
          foreach ($counts as $index => $product) {
            $post = get_post($index);
            $pn_number = get_field('pn_number', $post->ID);
            $sku = get_field('sku', $post->ID);
            $mil_number = get_field('mil_number', $post->ID);
            $following_hose = get_field('following_hose', $post->ID);
            $following_hose_second = get_field('following_hose_second', $post->ID);
            $hose_to_flange_heading = get_field('hose_to_flange_heading', $post->ID);
            $hose_to_flange = get_field('hose_to_flange', $post->ID);
            $types = get_field('types', $post->ID);
            $flange_per = get_field('flange_per', $post->ID);
            $images = get_field('images', $post->ID);
            $feature_image = get_the_post_thumbnail_url($post);
            ?>
            <tr class="product-wrapper" id="product-<?php echo $post->ID; ?>">
              <td>
                <div class="pc_Img">
                  <img src="<?php echo $feature_image; ?>" alt="">
                </div>
                <div style="margin-left: 25%" class=" my-auto text-left">
                  <?php
                  if ($pn_number) {
                    echo '<p>' . $pn_number . '</p>';
                  }

                  echo '<p>';
                  categories_list($post->ID);
                  echo '</p>';
                  if ($mil_number) {
                    echo '<h6>' . $mil_number . '</h6>';
                  }

                  if ($following_hose) {
                    echo '<p><strong>Use with the following hose:</strong>' . $following_hose . '</p>';
                  }
                  if ($following_hose_second) {
                    echo '<p>' . $following_hose_second . '</p>';
                  }
                  ?>
                </div>
              </td>
              <td>
                <?php echo $product; ?>
              </td>
              <td>
                <i class="fa-regular fa-circle-xmark btn-remove" data-cookie="<?php echo $post->ID; ?>"></i>
              </td>
            </tr>
            <?php
          }
        }
        ?>
      </tbody>
    </table>
    <hr />
    <div id="cartFORM" class="text-center">
      <form method="post" id="form" class="validate">
        <div class="form-field">
          <label for="fisrt-name">First Name</label>
          <input type="text" name="fisrt_name" id="fisrt-name" placeholder="Joe Bloggs" required />
        </div>
        <div class="form-field">
          <label for="last-name">Last Name</label>
          <input type="text" name="last_name" id="last-name" placeholder="Joe Bloggs" required />
        </div>
        <div class="form-field">
          <label for="phone">Phone</label>
          <input type="text" name="phone" id="phone" placeholder="(XXX) XXX-XXXX" required />
        </div>
        <div class="form-field">
          <label for="email-input">Email</label>
          <input type="email" name="user_email" id="email-input" placeholder="example@domain.com" required />
        </div>
        <div class="form-field">
          <label for="company">Company</label>
          <input type="text" name="company" id="company" placeholder="XYZ" required />
        </div>
        <div class="form-field">
          <label class="form-label">Country</label>
          <select name="country">
            <option value="AF">Afghanistan</option>
            <option value="AL">Albania</option>
            <option value="DZ">Algeria</option>
            <option value="AS">American Samoa</option>
            <option value="AD">Andorra</option>
            <option value="AO">Angola</option>
            <option value="AI">Anguilla</option>
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
            <option value="BA">Bosnia and Herzegovina</option>
            <option value="BW">Botswana</option>
            <option value="BR">Brazil</option>
            <option value="BN">Brunei</option>
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
            <option value="CO">Colombia</option>
            <option value="KM">Comoros</option>
            <option value="CG">Congo</option>
            <option value="CD">Congo (DRC)</option>
            <option value="CR">Costa Rica</option>
            <option value="HR">Croatia</option>
            <option value="CU">Cuba</option>
            <option value="CY">Cyprus</option>
            <option value="CZ">Czechia</option>
            <option value="DK">Denmark</option>
            <option value="DJ">Djibouti</option>
            <option value="DM">Dominica</option>
            <option value="DO">Dominican Republic</option>
            <option value="EC">Ecuador</option>
            <option value="EG">Egypt</option>
            <option value="SV">El Salvador</option>
            <option value="GQ">Equatorial Guinea</option>
            <option value="ER">Eritrea</option>
            <option value="EE">Estonia</option>
            <option value="SZ">Eswatini</option>
            <option value="ET">Ethiopia</option>
            <option value="FJ">Fiji</option>
            <option value="FI">Finland</option>
            <option value="FR">France</option>
            <option value="GA">Gabon</option>
            <option value="GM">Gambia</option>
            <option value="GE">Georgia</option>
            <option value="DE">Germany</option>
            <option value="GH">Ghana</option>
            <option value="GR">Greece</option>
            <option value="GD">Grenada</option>
            <option value="GT">Guatemala</option>
            <option value="GN">Guinea</option>
            <option value="GW">Guinea-Bissau</option>
            <option value="GY">Guyana</option>
            <option value="HT">Haiti</option>
            <option value="HN">Honduras</option>
            <option value="HU">Hungary</option>
            <option value="IS">Iceland</option>
            <option value="IN">India</option>
            <option value="ID">Indonesia</option>
            <option value="IR">Iran</option>
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
            <option value="KW">Kuwait</option>
            <option value="KG">Kyrgyzstan</option>
            <option value="LA">Laos</option>
            <option value="LV">Latvia</option>
            <option value="LB">Lebanon</option>
            <option value="LS">Lesotho</option>
            <option value="LR">Liberia</option>
            <option value="LY">Libya</option>
            <option value="LI">Liechtenstein</option>
            <option value="LT">Lithuania</option>
            <option value="LU">Luxembourg</option>
            <option value="MG">Madagascar</option>
            <option value="MW">Malawi</option>
            <option value="MY">Malaysia</option>
            <option value="MV">Maldives</option>
            <option value="ML">Mali</option>
            <option value="MT">Malta</option>
            <option value="MH">Marshall Islands</option>
            <option value="MR">Mauritania</option>
            <option value="MU">Mauritius</option>
            <option value="MX">Mexico</option>
            <option value="FM">Micronesia</option>
            <option value="MD">Moldova</option>
            <option value="MC">Monaco</option>
            <option value="MN">Mongolia</option>
            <option value="ME">Montenegro</option>
            <option value="MA">Morocco</option>
            <option value="MZ">Mozambique</option>
            <option value="MM">Myanmar</option>
            <option value="NA">Namibia</option>
            <option value="NR">Nauru</option>
            <option value="NP">Nepal</option>
            <option value="NL">Netherlands</option>
            <option value="NZ">New Zealand</option>
            <option value="NI">Nicaragua</option>
            <option value="NE">Niger</option>
            <option value="NG">Nigeria</option>
            <option value="NO">Norway</option>
            <option value="OM">Oman</option>
            <option value="PK">Pakistan</option>
            <option value="PW">Palau</option>
            <option value="PA">Panama</option>
            <option value="PG">Papua New Guinea</option>
            <option value="PY">Paraguay</option>
            <option value="PE">Peru</option>
            <option value="PH">Philippines</option>
            <option value="PL">Poland</option>
            <option value="PT">Portugal</option>
            <option value="QA">Qatar</option>
            <option value="RO">Romania</option>
            <option value="RU">Russia</option>
            <option value="RW">Rwanda</option>
            <option value="KN">Saint Kitts and Nevis</option>
            <option value="LC">Saint Lucia</option>
            <option value="VC">Saint Vincent and the Grenadines</option>
            <option value="WS">Samoa</option>
            <option value="SM">San Marino</option>
            <option value="ST">Sao Tome and Principe</option>
            <option value="SA">Saudi Arabia</option>
            <option value="SN">Senegal</option>
            <option value="RS">Serbia</option>
            <option value="SC">Seychelles</option>
            <option value="SL">Sierra Leone</option>
            <option value="SG">Singapore</option>
            <option value="SK">Slovakia</option>
            <option value="SI">Slovenia</option>
            <option value="SB">Solomon Islands</option>
            <option value="SO">Somalia</option>
            <option value="ZA">South Africa</option>
            <option value="KR">South Korea</option>
            <option value="SS">South Sudan</option>
            <option value="ES">Spain</option>
            <option value="LK">Sri Lanka</option>
            <option value="SD">Sudan</option>
            <option value="SR">Suriname</option>
            <option value="SE">Sweden</option>
            <option value="CH">Switzerland</option>
            <option value="SY">Syria</option>
            <option value="TW">Taiwan</option>
            <option value="TJ">Tajikistan</option>
            <option value="TZ">Tanzania</option>
            <option value="TH">Thailand</option>
            <option value="TL">Timor-Leste</option>
            <option value="TG">Togo</option>
            <option value="TO">Tonga</option>
            <option value="TT">Trinidad and Tobago</option>
            <option value="TN">Tunisia</option>
            <option value="TR">Turkey</option>
            <option value="TM">Turkmenistan</option>
            <option value="TV">Tuvalu</option>
            <option value="UG">Uganda</option>
            <option value="UA">Ukraine</option>
            <option value="AE">United Arab Emirates</option>
            <option value="GB">United Kingdom</option>
            <option value="US">United States</option>
            <option value="UY">Uruguay</option>
            <option value="UZ">Uzbekistan</option>
            <option value="VU">Vanuatu</option>
            <option value="VE">Venezuela</option>
            <option value="VN">Vietnam</option>
            <option value="YE">Yemen</option>
            <option value="ZM">Zambia</option>
            <option value="ZW">Zimbabwe</option>
          </select>
        </div>
        <div class="form-field">
          <label for="comments">Comments</label>
          <textarea name="comments" id="comments" placeholder="Comments" required></textarea>
        </div>
        <?php 
        if ($counts){
          foreach($counts as $index => $count){
            echo '<input type="hidden" name="idz['.$count.']" value="'.$index.'">';
          }
        }
        ?>
        <input type="hidden" name="action" value="email_ftn">
        <div class="form-field">
          <label for=""></label>
          <input type="submit" value="Submit" />
        </div>
      </form>
    </div>
  </div>
  <?php
} else {
  ?>
  <table style="margin: 0px auto;">
    <tbody>
      <tr>
        <th>Your Cart is Empty!</th>
      </tr>
    </tbody>
  </table>
  <?php
}
get_footer();