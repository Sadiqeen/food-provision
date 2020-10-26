<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Local',
                'created_at' => '2020-10-26 09:44:51',
                'updated_at' => '2020-10-26 09:44:51',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Imported',
                'created_at' => '2020-10-26 09:44:51',
                'updated_at' => '2020-10-26 09:44:51',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sai nam pung',
                'created_at' => '2020-10-26 09:44:51',
                'updated_at' => '2020-10-26 09:44:51',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mejji',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Australia',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'New Zealand',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Hi-Breed',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Import',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'NZ',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'AERO,CP,SAHAFARM',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'CANADA',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Man A',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'FARM FRITES',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Bavashi',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Imperial',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Paramesan ',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Anchor',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'ARO',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Allowrie',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Mena Food',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'COMPANY B',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Putra',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Ramly',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Spring Home',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'CP',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'PFP',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Mumtaz',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Nestle',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Quaker',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Kellogg\'s',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Mueslix',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Alpen',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Heinz',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            33 => 
            array (
                'id' => 34,
            'name' => 'Maggi(Malaysia)',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Gloden Moutain',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            35 => 
            array (
                'id' => 36,
            'name' => 'Maggi (Malaysia)',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'ABC Indonisaia',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Sriracha',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'A 1',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'A 2',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Deksomboon',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => '3 Mai Kro',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            42 => 
            array (
                'id' => 43,
            'name' => 'ABC (Indonisaia)',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'UFC',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Mea Panom',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Pantainorasin',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Tipparot',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Plamuk,Huylod',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Knorr',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'L&P',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            50 => 
            array (
                'id' => 51,
            'name' => 'Serda (THAILAND)',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            51 => 
            array (
                'id' => 52,
            'name' => 'RUSKI (THAILAND)',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            52 => 
            array (
                'id' => 53,
            'name' => 'JAYA (THAILAND)',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Indomie',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            54 => 
            array (
                'id' => 55,
            'name' => 'Sedaap(Malaysia)',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Noodde',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Mica',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Brook',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Pigeon',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Mea-Pranom',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Durkee',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Royal',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Best Food',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Horlicks',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Croste',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Mayagold',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Red Lotus',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Gogi',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Yeos',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Nutella',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Skipply',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Mitphol',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Vejpong ',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Hershey ',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Imperial, Asenal',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Jacop',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Hup Seng',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Pringles',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Farm house',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Malee',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Nortirut',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Ayam',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Super rechef',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Dragon',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Sim',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Aero',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Term Thip',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'ROYAL Umbrella A',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'ROYAL Umbrella B',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'PARI',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Snake',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Kewpie',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Coleman',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            93 => 
            array (
                'id' => 94,
            'name' => 'condoliva (BTL)',
                'created_at' => '2020-10-26 09:44:52',
                'updated_at' => '2020-10-26 09:44:52',
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'Prego',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Coke',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'pepsi',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Est',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Fanta',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'Sprite',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'Oishi',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'Malee/UFC/Tipco',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'Redbull',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'M150',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'White Shark',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Vitamilk/Lattasoy',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Nescafe',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Bonecafe',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Khao Chong',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'Lipston',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'Nestea',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'Ranong',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'Hand',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'Milo',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'Ovaltin ',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'CARNATION',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'Foremost',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'Anlene',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'Sun quick',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'DING FONG',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'Hales Blue boy ',
                'created_at' => '2020-10-26 09:44:53',
                'updated_at' => '2020-10-26 09:44:53',
            ),
        ));
        
        
    }
}