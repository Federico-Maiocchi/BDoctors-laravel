<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Sponsorship;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // Recupera tutti gli utenti dal database
        $users = User::all();
        // Estrae gli ID degli utenti e crea un array di ID
        $userIds = $users->pluck('id');


        $sponsorships = Sponsorship::all();
        $sponsorships_id = $sponsorships->pluck('id');

        $specializations = Specialization::all();
        $specializations_id = $specializations->pluck('id');

        $addresses = [
            "Via Roma, 1, 20121 Milano MI",
            "Corso Vittorio Emanuele II, 15, 00186 Roma RM",
            "Piazza del Duomo, 6, 40124 Bologna BO",
            "Corso Umberto I, 10, 10121 Torino TO",
            "Via della Moscova, 13, 20121 Milano MI",
            "Viale della Libertà, 28, 50129 Firenze FI",
            "Via San Gregorio Armeno, 1, 80138 Napoli NA",
            "Corso Buenos Aires, 33, 20124 Milano MI",
            "Via Po, 10, 10123 Torino TO",
            "Via del Corso, 80, 00187 Roma RM",
            "Corso Italia, 45, 16126 Genova GE",
        ];

        $phoneNumbers = [
            "+39 02 1234567",
            "+39 06 9876543",
            "+39 051 1122334",
            "+39 011 4455667",
            "+39 02 9876543",
            "+39 055 4455667",
            "+39 081 1122334",
            "+39 02 8765432",
            "+39 011 7788999",
            "+39 06 8765432",
            "+39 010 1122334",
        ];

        $medicalServices = [
            "Cardiologia",
            "Ortopedia",
            "Ginecologia",
            "Pediatria",
            "Oncologia",
            "Neurologia",
            "Dermatologia",
            "Medicina Interna",
            "Oculistica",
            "Psichiatria",
            "Chirurgia Generale",
        ];

        $doctorImages = [
            'images/doc1.jpg',
            'images/doc2.jpg',
            'images/doc3.jpg',
            'images/doc4.jpg',
            'images/doc5.jpg',
            'images/doc6.webp',
            'images/doc7.jpg',
            'images/doc8.jpg',
            'images/doc9.jpg',
            'images/doc10.jpg',
            'images/doc11.jpg',
        ];

        $pdfFolderPath = public_path('pdf');
        $pdfFiles = File::files($pdfFolderPath);

        for ($i = 0; $i < 11; $i++) {
            $new_doctor = new Doctor();
            $new_doctor->curriculum = 'pdf/' . $pdfFiles[$i % count($pdfFiles)]->getFilename();
            $new_doctor->photo = $doctorImages[$i];
            $new_doctor->address = $addresses[$i];
            $new_doctor->phone_number = $phoneNumbers[$i];
            $new_doctor->medical_services = $medicalServices[$i];

            // Assegna l'ID di un utente specifico a un nuovo dottore
            $new_doctor->user_id = $userIds[$i];

            $new_doctor->save();
            //seleziona casualmente un ID di sponsorizzazione.
            $sponsorshipId = $faker->randomElement($sponsorships_id);
            // trova la sponsorizzazione corrispondente all'ID casuale.
            $sponsorship = Sponsorship::find($sponsorshipId);
            // ottiene il prezzo totale della sponsorizzazione selezionata.
            $totalPrice = $sponsorship->price;




            //genera data inizio abbonamento, data random ultimi 10 gg
            $start_date = Carbon::now()->subDays(rand(0, 10))->addSeconds(rand(0, 86400));
            // recupero durata da sposorship
            $duration = $sponsorship->duration;
            // calcola end_date tramite start_date e durata 
            $end_date = $start_date->copy()->addHours($duration);
            // allega la sponsorizzazione al dottore corrente con l'ID della sponsorizzazione casuale insieme alla data di inizio e al prezzo totale e end_date.
            $new_doctor->sponsorships()->attach($sponsorshipId, ['start_date' => $start_date, 'total' => $totalPrice, 'end_date' => $end_date]);
            $new_doctor->specializations()->attach($specializations_id->random(mt_rand(1, min(3, $specializations->count()))));
        }
    }
}
