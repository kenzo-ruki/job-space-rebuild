<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [1, 'Afghanistan', 'AF'],
            [2, 'Albania', 'AL'],
            [3, 'Algeria', 'DZ'],
            [4, 'American Samoa', 'AS'],
            [5, 'Andorra', 'AD'],
            [6, 'Angola', 'AO'],
            [7, 'Anguilla', 'AI'],
            [8, 'Antarctica', 'AQ'],
            [9, 'Antigua and Barbuda', 'AG'],
            [10, 'Argentina', 'AR'],
            [11, 'Armenia', 'AM'],
            [12, 'Aruba', 'AW'],
            [13, 'Australia', 'AU'],
            [14, 'Austria', 'AT'],
            [15, 'Azerbaijan', 'AZ'],
            [16, 'Bahamas', 'BS'],
            [17, 'Bahrain', 'BH'],
            [18, 'Bangladesh', '88'],
            [19, 'Barbados', 'BB'],
            [20, 'Belarus', 'BY'],
            [21, 'Belgium', 'BE'],
            [22, 'Belize', 'BZ'],
            [23, 'Benin', 'BJ'],
            [24, 'Bermuda', 'BM'],
            [25, 'Bhutan', 'BT'],
            [26, 'Bolivia', 'BO'],
            [27, 'Bosnia and Herzegowina', 'BA'],
            [28, 'Botswana', 'BW'],
            [29, 'Bouvet Island', 'BV'],
            [30, 'Brazil', 'BR'],
            [31, 'British Indian Ocean Territory', 'IO'],
            [32, 'Brunei Darussalam', 'BN'],
            [33, 'Bulgaria', 'BG'],
            [34, 'Burkina Faso', 'BF'],
            [35, 'Burundi', 'BI'],
            [36, 'Cambodia', 'KH'],
            [37, 'Cameroon', 'CM'],
            [38, 'Canada', 'CA'],
            [39, 'Cape Verde', 'CV'],
            [40, 'Cayman Islands', 'KY'],
            [41, 'Central African Republic', 'CF'],
            [42, 'Chad', 'TD'],
            [43, 'Chile', 'CL'],
            [44, 'China', 'CN'],
            [45, 'Christmas Island', 'CX'],
            [46, 'Cocos [Keeling) Islands', 'CC'],
            [47, 'Colombia', 'CO'],
            [48, 'Comoros', 'KM'],
            [49, 'Congo', 'CG'],
            [50, 'Cook Islands', 'CK'],
            [51, 'Costa Rica', 'CR'],
            [52, 'Cote D\'Ivoire', 'CI'],
            [53, 'Croatia', 'HR'],
            [54, 'Cuba', 'CU'],
            [55, 'Cyprus', 'CY'],
            [56, 'Czech Republic', 'CZ'],
            [57, 'Denmark', 'DK'],
            [58, 'Djibouti', 'DJ'],
            [59, 'Dominica', 'DM'],
            [60, 'Dominican Republic', 'DO'],
            [61, 'East Timor', 'TP'],
            [62, 'Ecuador', 'EC'],
            [63, 'Egypt', 'EG'],
            [64, 'El Salvador', 'SV'],
            [65, 'Equatorial Guinea', 'GQ'],
            [66, 'Eritrea', 'ER'],
            [67, 'Estonia', 'EE'],
            [68, 'Ethiopia', 'ET'],
            [69, 'Falkland Islands [Malvinas)', 'FK'],
            [70, 'Faroe Islands', 'FO'],
            [71, 'Fiji', 'FJ'],
            [72, 'Finland', 'FI'],
            [73, 'France', 'FR'],
            [74, 'France, Metropolitan', 'FX'],
            [75, 'French Guiana', 'GF'],
            [76, 'French Polynesia [Tahiti)', 'PF'],
            [77, 'French Southern Territories', 'TF'],
            [78, 'Gabon', 'GA'],
            [79, 'Gambia', 'GM'],
            [80, 'Georgia', 'GE'],
            [81, 'Germany', 'DE'],
            [82, 'Ghana', 'GH'],
            [83, 'Gibraltar', 'GI'],
            [84, 'Greece', 'GR'],
            [85, 'Greenland', 'GL'],
            [86, 'Grenada', 'GD'],
            [87, 'Guadeloupe', 'GP'],
            [88, 'Guam', 'GU'],
            [89, 'Guatemala', 'GT'],
            [90, 'Guinea', 'GN'],
            [91, 'Guinea-bissau', 'GW'],
            [92, 'Guyana', 'GY'],
            [93, 'Haiti', 'HT'],
            [94, 'Heard and Mc Donald Islands', 'HM'],
            [95, 'Honduras', 'HN'],
            [96, 'Hong Kong', 'HK'],
            [97, 'Hungary', 'HU'],
            [98, 'Iceland', 'IS'],
            [99, 'India', 'IN'],
            [100, 'Indonesia', 'ID'],
            [101, 'Iran [Islamic Republic of)', 'IR'],
            [102, 'Iraq', 'IQ'],
            [103, 'Ireland', 'IE'],
            [104, 'Israel', 'IL'],
            [105, 'Italy', 'IT'],
            [106, 'Jamaica', 'JM'],
            [107, 'Japan', 'JP'],
            [108, 'Jordan', 'JO'],
            [109, 'Kazakhstan', 'KZ'],
            [110, 'Kenya', 'KE'],
            [111, 'Kiribati', 'KI'],
            [112, 'Korea, Democratic People\'s Republic of', 'KP'],
            [113, 'Korea, Republic of', 'KR'],
            [114, 'Kuwait', 'KW'],
            [115, 'Kyrgyzstan', 'KG'],
            [116, 'Lao People\'s Democratic Republic', 'LA'],
            [117, 'Latvia', 'LV'],
            [118, 'Lebanon', 'LB'],
            [119, 'Lesotho', 'LS'],
            [120, 'Liberia', 'LR'],
            [121, 'Libyan Arab Jamahiriya', 'LY'],
            [122, 'Liechtenstein', 'LI'],
            [123, 'Lithuania', 'LT'],
            [124, 'Luxembourg', 'LU'],
            [125, 'Macau', 'MO'],
            [126, 'Macedonia, The Former Yugoslav Republic of', 'MK'],
            [127, 'Madagascar', 'MG'],
            [128, 'Malawi', 'MW'],
            [129, 'Malaysia', 'MY'],
            [130, 'Maldives', 'MV'],
            [131, 'Mali', 'ML'],
            [132, 'Malta', 'MT'],
            [133, 'Marshall Islands', 'MH'],
            [134, 'Martinique', 'MQ'],
            [135, 'Mauritania', 'MR'],
            [136, 'Mauritius', 'MU'],
            [137, 'Mayotte', 'YT'],
            [138, 'Mexico', 'MX'],
            [139, 'Micronesia[Federated States of)', 'FM'],
            [140, 'Moldova, Republic of', 'MD'],
            [141, 'Monaco', 'MC'],
            [142, 'Mongolia', 'MN'],
            [143, 'Montserrat', 'MS'],
            [144, 'Morocco', 'MA'],
            [145, 'Mozambique', 'MZ'],
            [146, 'Myanmar', 'MM'],
            [147, 'Namibia', 'NA'],
            [148, 'Nauru', 'NR'],
            [149, 'Nepal', 'NP'],
            [150, 'Netherlands', 'NL'],
            [151, 'Netherlands Antilles', 'AN'],
            [152, 'New Caledonia', 'NC'],
            [153, 'New Zealand', 'NZ'],
            [154, 'Nicaragua', 'NI'],
            [155, 'Niger', 'NE'],
            [156, 'Nigeria', 'NG'],
            [157, 'Niue', 'NU'],
            [158, 'Norfolk Island', 'NF'],
            [159, 'Northern Mariana Islands', 'MP'],
            [160, 'Norway', 'NO'],
            [161, 'Oman', 'OM'],
            [162, 'Pakistan', 'PK'],
            [163, 'Palau', 'PW'],
            [164, 'Panama', 'PA'],
            [165, 'Papua New Guinea', 'PG'],
            [166, 'Paraguay', 'PY'],
            [167, 'Peru', 'PE'],
            [168, 'Philippines', 'PH'],
            [169, 'Pitcairn', 'PN'],
            [170, 'Poland', 'PL'],
            [171, 'Portugal', 'PT'],
            [172, 'Puerto Rico', 'PR'],
            [173, 'Qatar', 'QA'],
            [174, 'Reunion', 'RE'],
            [175, 'Romania', 'RO'],
            [176, 'Russian Federation', 'RU'],
            [177, 'Rwanda', 'RW'],
            [178, 'Saint Kitts and Nevis', 'KN'],
            [179, 'Saint Lucia', 'LC'],
            [180, 'Saint Vincent and the Grenadines', 'VC'],
            [181, 'Samoa', 'WS'],
            [182, 'San Marino', 'SM'],
            [183, 'Sao Tome and Principe', 'ST'],
            [184, 'Saudi Arabia', 'SA'],
            [185, 'Senegal', 'SN'],
            [186, 'Seychelles', 'SC'],
            [187, 'Sierra Leone', 'SL'],
            [188, 'Singapore', 'SG'],
            [189, 'Slovakia [Slovak Republic)', 'SK'],
            [190, 'Slovenia', 'SI'],
            [191, 'Solomon Islands', 'SB'],
            [192, 'Somalia', 'SO'],
            [193, 'South Africa', 'ZA'],
            [194, 'South Georgia and the South Sandwich Islands', 'GS'],
            [195, 'Spain', 'ES'],
            [196, 'Sri Lanka', 'LK'],
            [197, 'St. Helena', 'SH'],
            [198, 'St. Pierre and Miquelon', 'PM'],
            [199, 'Sudan', 'SD'],
            [200, 'Suriname', 'SR'],
            [201, 'Svalbard and Jan Mayen Islands', 'SJ'],
            [202, 'Swaziland', 'SZ'],
            [203, 'Sweden', 'SE'],
            [204, 'Switzerland', 'CH'],
            [205, 'Syrian Arab Republic', 'SY'],
            [206, 'Taiwan', 'TW'],
            [207, 'Tajikistan', 'TJ'],
            [208, 'Tanzania, United Republic of', 'TZ'],
            [209, 'Thailand', 'TH'],
            [210, 'Togo', 'TG'],
            [211, 'Tokelau', 'TK'],
            [212, 'Tonga', 'TO'],
            [213, 'Trinidad and Tobago', 'TT'],
            [214, 'Tunisia', 'TN'],
            [215, 'Turkey', 'TR'],
            [216, 'Turkmenistan', 'TM'],
            [217, 'Turks and Caicos Islands', 'TC'],
            [218, 'Tuvalu', 'TV'],
            [219, 'Uganda', 'UG'],
            [220, 'Ukraine', 'UA'],
            [221, 'uae', 'AE'],
            [222, 'United Kingdom', 'GB'],
            [223, 'United States', 'US'],
            [224, 'United States Minor Outlying Islands', 'UM'],
            [225, 'Uruguay', 'UY'],
            [226, 'Uzbekistan', 'UZ'],
            [227, 'Vanuatu', 'VU'],
            [228, 'Vatican City State [Holy See)', 'VA'],
            [229, 'Venezuela', 'VE'],
            [230, 'Viet Nam', 'VN'],
            [231, 'Virgin Islands [British)', 'VG'],
            [232, 'Virgin Islands [U.S.)', 'VI'],
            [233, 'Wallis and Futuna Islands', 'WF'],
            [234, 'Western Sahara', 'EH'],
            [235, 'Yemen', 'YE'],
            [237, 'Zaire', 'ZR'],
            [238, 'Zambia', 'ZM'],
            [239, 'Zimbabwe', 'ZW'],
            [240, 'Laos', 'LA'],
            [241, 'Viet Nam', 'VN'],
            [242, 'Timor-Leste', 'TL'],
            [243, 'Iran', 'IR'],
            [244, 'Syria', 'SY'],
            [245, 'Palestine', '0'],
            [246, 'Kosovo', 'KS'],
            [247, 'Macedonia', '0'],
            [248, 'Montenegro', '0'],
            [249, 'Serbia', '0'],
            [250, 'Slovenia', '0']
        ];

        foreach ($countries as $country) {
            Country::create([
                'id' => $country[0],
                'name' => $country[1],
                'code' => $country[2],
            ]);
        }
    }
}