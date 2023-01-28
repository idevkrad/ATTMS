<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThesesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('theses')->delete();
        
        \DB::table('theses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'ENG-2023-01-0001',
                'title' => 'TAP To GO: Automated Seaport Ticketing System With RFID-based Reloadable Passenger Card For Zamboanga City Port',
                'abstract' => 'Zamboanga City is comprised of different tribes from different places. It is also  the center of trade and commerce in the Western Mindanao. With that, the shipping industry has been a great help for the people travelling to and from  the nearby provinces that are south of Zamboanga, such as Basilan and Sulu,  that come for personal or business purposes regularly. These provinces are  islands, entailing that the common and desirable means of travel is by a vessel  on sea. Based from the interviews conducted with the various shipping lines at  the Zamboanga City Port, the ticketing system operations in Zamboanga City  continue to function manually. The Department of Trade and Industry’s article  on the volume of passengers travelling back and forth the nearby provinces  states that most of the daily passengers travel in and out of the city many times  a week, and the degree increases on weekends. 

With the current ticketing system, passengers could only purchase their ticket  at the designated ticketing area outside the Port Area Proper. The ticketing  agents conduct their daily operations manually, writing each passenger’s name  on the ticket and passenger manifest. They also generate their reports by  manually tallying all the tickets sold and writing everything down on a paper. This has led the researchers to develop TAP to GO: Automated Seaport  Ticketing System with RFID-based Reloadable Passenger Card for Zamboanga  City Port, a system that runs on three platforms – web application, mobile  application and self-serve kiosk – that provides an automated sea transport  ticketing system for passengers to travel with added convenience and shipping  companies to operate their transactions more efficiently.  

The system provides an easy retrieval of passenger information, automatic  application of discounts to passengers, online and off-site booking for  passengers, cashless transactions, twenty-four (24) hour availability and quick  generation of reports.',
                'publication' => 2019,
                'attachment' => 'uploads/ENG-2023-01-0001.pdf',
                'has_hardbound' => 1,
                'has_cd' => 0,
                'department_id' => 2,
                'status_id' => 1,
                'user_id' => 1,
                'created_at' => '2023-01-24 16:29:52',
                'updated_at' => '2023-01-24 16:29:52',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'ENG-2023-01-0002',
                'title' => 'Scrabble Word Detection Via Tile Recognition With Automation Of Score Tallying And Word Verification Using Raspberry Pi',
                'abstract' => 'Scrabble is a classic board game in which players can flaunt their  vocabulary and word skills while engaging socially, with the thrill of  competing given a limited number of letters for each player. Two to four  players can participate in the game with the liberty to discuss the words  and language during the occasion. Resembling other word games,  Scrabble employs a pen-and-paper system of recording the words used  and points earned, which implies a time-consuming and hassle  undertaking for all the players. However, the advent of technology has  given way for electronic means of recording Scrabble games. Scrabble  detectors have been crafted and produced in the market that takes the  form of a mere mobile application or one that comes with a hardware  equipment. Unfortunately, these existing applications lack accuracy in  identifying the words laid out on a Scrabble board.  

In light of this, the researchers have developed a Scrabble Word  Detection via Tile Recognition with Automation of Score Tallying and  Word Verification using Raspberry Pi that aims to automate the  validation of the played words and score tallying. The system will be  employing an image processing technology with machine learning in  the entirety of the study. The in-house dictionary will provide a better  and more accurate word validation while the different modules that will  be discussed in this paper will offer computerization of score tallying.',
                'publication' => 2019,
                'attachment' => 'uploads/ENG-2023-01-0002.pdf',
                'has_hardbound' => 1,
                'has_cd' => 0,
                'department_id' => 2,
                'status_id' => 1,
                'user_id' => 1,
                'created_at' => '2023-01-24 16:32:11',
                'updated_at' => '2023-01-24 16:32:11',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'ENG-2023-01-0003',
            'title' => 'Enhancement Of The Daily Time Record (DTR)system Of The Ateneo De Zamboanga University',
            'abstract' => 'The Ateneo de Zamboanga University is one of many universities in the  Philippines that utilizes an automated daily time record (DTR) system to monitor the  attendance of its employees on a daily basis. Their current DTR system allows the  school to view the In and Out logs of the employees as they enter and leave the campus  which makes it as the basis of attendance of the employees. 

There are some cases in which the DTR system would not be functioning properly  due to the corruption of the local database files used by the system to save the daily  logs of the employees. When the files have been corrupted, a new database folder must  be created to run the system again and the corrupted files can only be viewed by using  a certain application and password. 

As a result, the need for a new format in which the logs of the employees are saved  locally arise. This led to the development of the Enhanced DTR system which was  aimed to change the old database format of the DTR system into a new database format  that would not be corrupted and is user friendly. Lastly, all the shortcomings of the old  DTR system were aimed to be addressed by the enhanced DTR system that was  developed.',
                'publication' => 2022,
                'attachment' => 'uploads/ENG-2023-01-0003.pdf',
                'has_hardbound' => 1,
                'has_cd' => 0,
                'department_id' => 2,
                'status_id' => 1,
                'user_id' => 1,
                'created_at' => '2023-01-24 16:33:59',
                'updated_at' => '2023-01-24 16:33:59',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'NS-2023-01-0001',
            'title' => 'Antibacterial Activity Of Talisay (Terminalia Catappa Linnaeus) Fruit Extracts  At Different Stages Of Maturity',
            'abstract' => 'Stages of maturity in plant parts is an underrepresented variable in extract acquisition, which was highlighted by Akharaiyi et al. (2011) to have significance  in antibacterial activity. With ethanol being a more effective extracting solvent, particularly in bringing out phenolic compounds, this study utilized ethanolic',
                'publication' => 2022,
                'attachment' => NULL,
                'has_hardbound' => 1,
                'has_cd' => 0,
                'department_id' => 4,
                'status_id' => 1,
                'user_id' => 1,
                'created_at' => '2023-01-26 13:37:49',
                'updated_at' => '2023-01-26 13:37:49',
            ),
        ));
        
        
    }
}