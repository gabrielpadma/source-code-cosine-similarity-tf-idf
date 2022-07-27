<?php
class Cosine
{
    private function _preproses($teks)
    {

        $this->load->library('sastrawi');
        // case folding
        $str = strtolower(trim($teks));

        //hilangkan tanda baca aka tokenizing
        //$str = str_replace("'", " ", $str);
        $str = str_replace("-", " ", $str);
        $str = str_replace(")", " ", $str);
        $str = str_replace("(", " ", $str);
        $str = str_replace("\"", " ", $str);
        $str = str_replace("/", " ", $str);
        $str = str_replace("=", " ", $str);
        $str = str_replace(".", " ", $str);
        $str = str_replace(",", " ", $str);
        $str = str_replace(":", " ", $str);
        $str = str_replace(";", " ", $str);
        $str = str_replace("!", " ", $str);
        $str = str_replace("?", " ", $str);
        $str = str_replace("<p>", " ", $str);
        $str = str_replace("</p>", " ", $str);
        $str = str_replace("<ol>", " ", $str);
        $str = str_replace("</ol>", " ", $str);
        $str = str_replace("<li>", " ", $str);
        $str = str_replace("</li>", " ", $str);
        $str = str_replace("<ul>", " ", $str);
        $str = str_replace("< li>", " ", $str);
        $str = str_replace("< ul>", " ", $str);
        $str = str_replace("< ol>", " ", $str);
        $str = str_replace("&nbsp", " ", $str);


        $str = strtolower(trim($str));



        //stopword aka filtering
        $astoplist = array("kondisi", "keadaan", "terdapat", "di", "am", "ajak", "akan", "beliau", "khan", "lah", "dong", "ahh", "sob", "elo", "so", "kena", "yang", "dan", "agak", "kata", "bilang", "sejak", "kagak", "cukup", "jua", "cuma", "hanya", "karena", "oleh", "lain", "setiap", "untuk", "dari", "dapat", "dapet", "sudah", "udah", "selesai", "punya", "boleh", "gue", "gua", "aku", "kamu", "dia", "mereka", "kami", "kita", "jika", "bila", "kalo", "kalau", "dalam", "nya", "atau", "seperti", "mungkin", "sering", "kerap", "acap", "harus", "banyak", "doang", "kemudian", "nyala", "mati", "milik", "juga", "mau",  "dengan", "kalian", "bakal", "bakalan", "tentang", "setelah", "hadap", "semua", "hampir", "antara", "sebuah", "apapun", "sebagai", "di", "tapi", "lainnya", "bagaimana", "namun", "tetapi", "biar", "pun", "itu", "ini", "suka", "paling", "mari", "ayo", "barangkali", "mudah", "kali", "sangat", "banget", "disana", "disini", "terlalu", "lalu", "terus", "trus", "sungguh", "telah", "mana", "apanya", "ada", "adanya", "adalah", "adapun", "agaknya", "agar", "akankah", "akhirnya", "akulah", "amat", "amatlah", "anda", "andalah", "antar", "diantaranya", "antaranya", "diantara", "apaan", "apabila", "apakah", "apalagi", "apatah", "ataukah", "ataupun", "bagai", "bagaikan", "sebagainya", "bagaimanapun", "sebagaimana", "bagaimanakah", "bagi", "bahkan", "bahwa", "bahwasanya", "sebaliknya", "sebanyak", "beberapa", "seberapa", "begini", "beginian", "beginikah", "beginilah", "sebegini", "begitu", "begitukah", "begitulah", "begitupun", "sebegitu", "belumlah", "sebelum", "sebelumnya", "sebenarnya", "berapa", "berapakah", "berapalah", "berapapun", "betulkah", "sebetulnya", "biasa", "biasanya", "bilakah", "sebisanya", "bolehkah", "bolehlah", "buat", "bukan", "bukankah", "bukanlah", "bukannya", "percuma", "dahulu", "daripada", "dekat", "demi", "demikian", "demikianlah", "sedemikian", "depan", "dialah", "dini", "diri", "dirinya", "terdiri", "dulu", "enggak", "enggaknya", "entah", "entahlah", "terhadap", "terhadapnya", "hal", "hanyalah", "haruslah", "harusnya", "seharusnya", "hendak", "hendaklah", "hendaknya", "hingga", "sehingga", "ia", "ialah", "ibarat", "ingin", "inginkah", "inginkan", "inikah", "inilah", "itukah", "itulah", "jangan", "jangankan", "janganlah", "jikalau", "justru", "kala", "kalaulah", "kalaupun", "kamilah", "kamulah", "kan", "kau", "kapankah", "kapanpun", "dikarenakan", "karenanya", "ke", "kecil", "kepada", "kepadanya", "ketika", "seketika", "khususnya", "kini", "kinilah", "kiranya", "sekiranya", "kitalah", "kok", "lagi", "lagian", "selagi", "melainkan", "selaku", "melalui", "lama", "lamanya", "selamanya", "lebih", "terlebih", "bermacam", "macam", "semacam", "maka", "makanya", "makin", "malah", "malahan", "mampu", "mampukah", "manakala", "manalagi", "masih", "masihkah", "semasih", "masing", "maupun", "semaunya", "memang", "merekalah", "meski", "meskipun", "semula", "mungkinkah", "nah", "nanti", "nantinya", "nyaris", "olehnya", "seorang", "seseorang", "pada", "padanya", "padahal", "sepanjang", "pantas", "sepantasnya", "sepantasnyalah", "para", "pasti", "pastilah", "per", "pernah", "pula", "merupakan", "rupanya", "serupa", "saat", "saatnya", "sesaat", "aja", "saja", "sajalah", "saling", "bersama", "sama", "sesama", "sambil", "sampai", "sana", "sangatlah", "saya", "sayalah", "se", "sebab", "sebabnya", "tersebut", "tersebutlah", "sedang", "sedangkan", "segala", "segalanya", "segera", "sesegera", "sejenak", "sekali", "sekalian", "sekalipun", "sesekali", "sekaligus", "sekarang", "sekitar", "sekitarnya", "sela", "selain", "selalu", "seluruh", "seluruhnya", "semakin", "sementara", "sempat", "semuanya", "sendiri", "sendirinya", "seolah", "sepertinya", "seringnya", "serta", "siapakah",  "disinilah", "sini", "sinilah", "sesuatu", "sesuatunya", "suatu", "sesudah", "sesudahnya", "sudahkah", "sudahlah", "supaya", "tadi", "tadinya", "tak", "tanpa", "tentu", "tentulah", "tertentu", "seterusnya", "tiap", "toh", "waduh", "wah", "wahai", "sewaktu", "walau", "walaupun", "wong", "yaitu", "yakni", "pelaporan");


        $str = preg_replace('/\b(' . implode('|', $astoplist) . ')\b/', '', $str);

        return $this->sastrawi->stem($str);
        //return str_replace(' ', '', $this->sastrawi->stem($str));
        // $arrkata = explode(" ", $stem);
        // sort($arrkata);
        // return $arrkata;

        //return $str;
    }
    private function _tescosinenokat($DQ, $DN) //untuk tes recall
    {
        $kataquery = $DQ;
        $stemquery = $this->_preproses($DQ); //_preproses method require sastrawi library ,so this code will produce an error,if u want to run it without the _preproses method just delete it so its become like this $stemquery=$DQ and so on ,and so forth with the other codes
        $semuakalimat = [];
        $semuakalimat[] = $stemquery;
        array_push($semuakalimat, $this->_preproses($DN));

        $allterm = explode(" ", implode(" ", $semuakalimat));

        //-----------------------------------------pembobotan kata--------------------------------------

        $l = 0;
        $table1 = array();
        $search = array();
        foreach ($allterm as $key) {


            if (array_search(trim(strtolower($key)), $search) === false) {
                $dok = 0;

                $table1[$l]['term'] = trim(strtolower($key));
                $table1[$l]['dok'] = array();

                foreach ($semuakalimat as $key1) { // looping sebanyak jumlah dokumen

                    //masukan jumlah kata yg keluar ke array table1[0]['dok'] dari D0(Q) dari kata $key
                    array_push($table1[$l]['dok'], substr_count(trim(strtolower($key1)), trim(strtolower($key))));
                    //isi dari table[0]['dok']=1,2,3

                    ++$dok; //pre increment dok ke iterasi berikutnya yaitu dok 1
                }

                $akumulator = 0;
                for ($j = 0; $j < count($table1[$l]['dok']); $j++) {

                    if ($table1[$l]['dok'][$j] != 0) {
                        ++$akumulator;
                    }
                }
                //$table1[$l]['df'] = array_sum($table1[$l]['dok']);
                $table1[$l]['df'] = $akumulator;
                $table1[$l]['Ddf'] = count($table1[$l]['dok']) / $table1[$l]['df']; //menghitung d/df
                $table1[$l]['idf'] = round((log10($table1[$l]['Ddf']) + 1), 6);
                //$table1[$l]['idf1'] = round($table1[$l]['idf'] + 1, 3);
                ++$l;
                // var_dump($table1);
            }


            array_push($search, trim(strtolower($key)));
        }



        //---------------------pembobotan kalimat mengitung W masing masing dokumen-------------------------

        $bobot_dokumen = array();
        $y = 0;

        foreach ($semuakalimat as $key1) {
            $bobot_dokumen[$y]['a'] = array();

            foreach ($table1 as $key2) {
                //   echo $key2['dok'][$y] ;
                if ($key2['dok'][$y] > 0) {
                    array_push($bobot_dokumen[$y]['a'], $key2['dok'][$y] * $key2['idf']);
                } else {
                    array_push($bobot_dokumen[$y]['a'], 0);
                }
            }
            $bobot_dokumen[$y]['jml'] = round(array_sum($bobot_dokumen[$y]['a']), 6);
            ++$y;
        }
        $table2 = $bobot_dokumen;


        //-------------------perhitungan DxQ bobot masing masing dokumen terhadap vektor Q atau kata kunci------------------------------
        $bobotDxQ = [];
        $totalDxQ = [];
        $totalWKuadrat = [];

        for ($y = 1; $y < count($semuakalimat); $y++) {
            $totalDxQ['DxQdok' . strval($y)] = 0;
        }


        for ($y = 0; $y < count($semuakalimat); $y++) {
            $totalWKuadrat['Total_W_kuadrat_dok' . strval($y)] = 0;
        }



        for ($k = 0; $k < count($table1); $k++) {

            $y = 0;
            $bobotDxQ[$k]['term'] = trim(strtolower($table1[$k]['term']));


            for ($y = 1; $y < count($semuakalimat); $y++) {

                $bobotDxQ[$k]['DxQdok' . strval($y)] = $bobot_dokumen[0]['a'][$k] * $bobot_dokumen[$y]['a'][$k];
                // $bobotDxQ[$k]['W_kuadrat_dok' . strval($y - 1)] = $bobot_dokumen[$y - 1]['a'][$k];
                $totalDxQ['DxQdok' . strval($y)] +=  $bobotDxQ[$k]['DxQdok' . strval($y)];

                //array_push($bobotDxQ, ['total DxQ dok' . $y => 0]);
                // $bobotDxQ['total DxQ dok'] += $bobotDxQ[$k][' DxQ dok' . $y];
                // array_push($bobotDxQ[$u]['DxQ'], $bobot_dokumen[0]['a'][$k] * $bobot_dokumen[$y]['a'][$k]);
                // array_push($bobotDxQ[$u]['W^'], $bobot_dokumen[0]['a'][$k] * $bobot_dokumen[$y]['a'][$k]);
            }
        }


        //-----------------------menghitung bobot W Kuadrat-----------------------------
        for ($k = 0; $k < count($table1); $k++) {

            for ($y = 0; $y < count($semuakalimat); $y++) {
                $bobotDxQ[$k]['W_kuadrat_dok' . strval($y)] = pow($bobot_dokumen[$y]['a'][$k], 2); //pow untuk menghitung pangkat
                $totalWKuadrat['Total_W_kuadrat_dok' . strval($y)] +=  $bobotDxQ[$k]['W_kuadrat_dok' . strval($y)];
            }
        }






        //--menghitung cosine similaritynya ----
        $sim = [];
        $u = 0;
        for ($i = 1; $i < count($semuakalimat); $i++) {

            $sim['Sim_dok_ke_' . strval($i)] = [$totalDxQ["DxQdok" . $i] / (sqrt($totalWKuadrat["Total_W_kuadrat_dok0"]) * sqrt($totalWKuadrat["Total_W_kuadrat_dok" . $i])) * 100];
            echo 'teks yang dibandingkan = ' . $semuakalimat[0] . ' | teks Db = ' . $semuakalimat[1] . '  |Nilai SIM= ' . $sim['Sim_dok_ke_' . strval($i)][0] . '<br>';
            echo '<p>';

            ++$u;
        }

        return $sim;
    }

    public function tescosine()
    {


        $kataQ = [];
        $kataDoc = [];
        $kataQ['TMK'] = [
            'Website TMK tidak bisa melakukan registrasi , mohon segera dibantu karena batas waktu pengumpulan tmk akan ditutup',
            'nilai matakuliah kalkulus saya pada website TMK masih belum keluar harap dibantu karena saya mau menghitung nilai ipk saya',
            'Tidak bisa registrasi matakuliah pada halaman website TMK,harap segera diuruskan sebelum batas waktu pengumpulan TMK ditutup',
            'nilai matakuliah statistik masih belum keluar pada web TMK sedangkan teman saya yang lain sudah keluar nilainya',
            'nilai kalkulus saya masih belum keluar pada website TMK sedangkan teman saya yang lain sudah keluar nilainya',
            'nilai matakuliah bahasa indonesia saya masih belum keluar pada website tmk'
        ];

        $kataQ['Bahan Ajar/Modul'] = ['buku bahan ajar modul yang saya beli belum datang,jadinya saya tidak punya materi dalam mengerjakan TMK'];


        $kataQ['Ijazah'] = [
            'ijazah yang dikirimkan terdapat salah penulisan pada tahun kelulusan saya,harap lebih teliti lagi',
            'ada kesalahan penulisan pada tanggal lahir dari ijazah yang dikirimkan,tolong untuk lebih teliti lagi'
        ];

        $kataQ['Uang Kuliah'] = [
            'proses verifikasi pembayaran uang kuliah sangat lambat,alhasil saya harus membayar denda',
            'uang kuliah yang sudah dibayar masih belum diverifikasi harap segera diselesaikan agar saya tidak terkena denda',
            'Penurunan uang kuliah yang saya urus masih belum diverivikasi juga,tolong agar segera diverifikasi karena batas pembayaran uang kuliah sebentar lagi ditutup'
        ];

        $kataQ['Info UT'] = [
            'keterlambatan info yang diberikan dari pihak ut mengenai penurunan uang kuliah,harap agar lebih cepat dalam memberikan info ut',
            'terlambat memberikan info pendaftaran TMK pada website upbjj ut,tolong untuk lebih cepat lagi memberikan info ut',
            'terdapat kesalahan tanggal Info ut UAS THE yang diberikan,tolong untuk lebih teliti lagi memberikan info ke mahasiswa',
            'terdapat kesalahan tanggal info ut mengenai UAS THE susulan yang diumumkan,harap lebih teliti lagi sebelum memberikan info kepada kemahasiswa'
        ];
        //----------------------------------------------------Doc DB------------------------------------------------------------------------------------
        $kataDoc['TMK'] = [
            'Tidak bisa registrasi matakuliah pada halaman website TMK , harap segera diuruskan sebelum batas waktu pengumpulan TMK ditutup',
            'nilai matakuliah statistik masih belum keluar pada website TMK sedangkan teman saya sudah keluar nilainya',
            'nilai TMK saya masih tidak muncul di halaman TMK harap dibantu karena saya mau menghitung nilai ipk saya',
            'nilai matakuliah statistik pada website tmk,masih belum keluar',
            'nilai matakuliah statistik pada website tmk,masih belum keluar',
            'nilai matakuliah statistik pada website tmk,masih belum keluar'
        ];

        $kataDoc['Bahan Ajar/Modul'] = ['bahan ajar modul yang saya pesan ternyata rusak dan dan buku yang dikirimkan tidak sesuai yang dipesan'];

        $kataDoc['Ijazah'] = [
            'terdapat kesalahan penulisan pada nama ijazah saya harap diperiksa sebelum dikirimkan',
            'ijazah yang dikirimkan terdapat salah penulisan pada nim saya harap lebih teliti lagi'
        ];

        $kataDoc['Uang Kuliah'] = [
            'Pembayaran uang kuliah yang sudah saya bayar masih belum terverifikasi harap segera di uruskan karena saya bisa terkena denda jika terlambat diverifikasi',
            'Pembayaran uang kuliah yang sudah saya bayar masih belum terverifikasi harap segera di uruskan karena saya bisa terkena denda jika terlambat diverifikasi',
            'berkas penurunan uang kuliah saya belum diverifikasi,padahal batas pembayaran uang kuliah tinggal beberapa hari lagi,harap dipercepat !!!'
        ];

        $kataDoc['Info UT'] = [
            'ada kesalahan tanggal info ut mengenai UAS THE susulan,harap diperiksa lagi sebelum di infokan kemahasiswa',
            'keterlambatan info yang diberikan dari pihak ut mengenai penurunan uang kuliah pada website upbjj,harap agar lebih cepat dalam memberikan info ut',
            'terdapat kesalahan tanggal pada info registrasi mata kuliah yang diberikan,harap lebih teliti lagi sebelum memberikan info ut kepada mahasiswa',
            'terdapat kesalahan tanggal pada info registrasi mata kuliah yang diberikan,harap lebih teliti lagi sebelum memberikan info ut kepada mahasiswa'
        ];


        //var_dump($kataQ);

        /*   foreach ($kataQ as $key => $val) {

            for ($i = 0; $i < count($val); $i++) {
                var_dump($kataDoc[$key][$i]);
                if ($this->_tescosine($val[$i], $kataDoc[$key][$i], $key)['Sim_dok_ke_1'][0] < 60) {
                    echo "benar";
                    if ($i == count($val)) {
                        break;
                    }
                    array_unshift($kataDoc[$key], $val);
                    // var_dump($kataDoc[$key]);
                    echo "<p>";
                    $this->_tescosine($val[$i], $kataDoc[$key][$i], $key)['Sim_dok_ke_1'][0];
                } else if ($val[$i] == $kataDoc[$key][$i]) {
                    continue;
                } else if ($i == count($val)) {
                    break;
                }
                //var_dump($this->_tescosine($val[$i], $kataDoc[$key][$i], $key));
            }
        }*/

        foreach ($kataQ as $key => $val) {

            for ($i = 0; $i < count($val); $i++) {

                $this->_tescosinenokat($val[$i], $kataDoc[$key][$i]);
            }
        }
    }
}