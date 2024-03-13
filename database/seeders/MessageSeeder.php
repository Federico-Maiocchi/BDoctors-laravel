<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $doctors = Doctor::all();
        $doctors_ids = $doctors->pluck('id');

        for ($i = 0; $i < 100; $i++) {
            $messagesData = [
                [
                    'name' => 'Mario',
                    'surname' => 'Rossi',
                    'phone_number' => '+39 333 1234567',
                    'email' => 'mario.rossi@example.com',
                    'message' => 'Come posso fissare un appuntamento?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Laura',
                    'surname' => 'Bianchi',
                    'phone_number' => '+39 345 9876543',
                    'email' => 'laura.bianchi@example.com',
                    'message' => 'Quali sono i tuoi orari disponibili?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Giovanni',
                    'surname' => 'Verdi',
                    'phone_number' => '+39 366 2345678',
                    'email' => 'giovanni.verdi@example.com',
                    'message' => 'Hai disponibilità per una consulenza online?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Maria',
                    'surname' => 'Ricci',
                    'phone_number' => '+39 333 7654321',
                    'email' => 'maria.ricci@example.com',
                    'message' => 'Qual è la tua tariffa per una visita?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Luigi',
                    'surname' => 'Ferrari',
                    'phone_number' => '+39 345 8765432',
                    'email' => 'luigi.ferrari@example.com',
                    'message' => 'Accetti assicurazioni sanitarie?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Giulia',
                    'surname' => 'Mariani',
                    'phone_number' => '+39 366 5432109',
                    'email' => 'giulia.mariani@example.com',
                    'message' => 'Posso richiedere una prescrizione online?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Paolo',
                    'surname' => 'Galli',
                    'phone_number' => '+39 347 1230987',
                    'email' => 'paolo.galli@example.com',
                    'message' => 'Quanto dura una visita di routine?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Anna',
                    'surname' => 'Conti',
                    'phone_number' => '+39 366 8765432',
                    'email' => 'anna.conti@example.com',
                    'message' => 'Quali sono i documenti necessari per la prima visita?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Marco',
                    'surname' => 'Rinaldi',
                    'phone_number' => '+39 333 4567890',
                    'email' => 'marco.rinaldi@example.com',
                    'message' => 'Fornisci servizi di telemedicina?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Francesca',
                    'surname' => 'Moretti',
                    'phone_number' => '+39 345 6789012',
                    'email' => 'francesca.moretti@example.com',
                    'message' => 'Posso richiedere una visita specialistica?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Davide',
                    'surname' => 'Piazza',
                    'phone_number' => '+39 366 1234567',
                    'email' => 'davide.piazza@example.com',
                    'message' => 'Cosa posso fare in caso di emergenza?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Simona',
                    'surname' => 'Fabbri',
                    'phone_number' => '+39 347 5678901',
                    'email' => 'simona.fabbri@example.com',
                    'message' => 'Quanto costa una consulenza online?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Roberto',
                    'surname' => 'Gentile',
                    'phone_number' => '+39 366 8901234',
                    'email' => 'roberto.gentile@example.com',
                    'message' => 'Posso chiederti informazioni sui vaccini?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Elena',
                    'surname' => 'Santoro',
                    'phone_number' => '+39 333 5678901',
                    'email' => 'elena.santoro@example.com',
                    'message' => 'Quali esami consigli per la prevenzione?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Giovanni',
                    'surname' => 'Caruso',
                    'phone_number' => '+39 345 1234567',
                    'email' => 'giovanni.caruso@example.com',
                    'message' => 'Fornisci certificati per malattia?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Laura',
                    'surname' => 'Martini',
                    'phone_number' => '+39 366 7890123',
                    'email' => 'laura.martini@example.com',
                    'message' => 'Quando posso ritirare i risultati degli esami?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Alessandro',
                    'surname' => 'Vitali',
                    'phone_number' => '+39 347 2345678',
                    'email' => 'alessandro.vitali@example.com',
                    'message' => 'Come posso prenotare una visita?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Chiara',
                    'surname' => 'Rizzo',
                    'phone_number' => '+39 366 8901234',
                    'email' => 'chiara.rizzo@example.com',
                    'message' => 'Offri consulenze online?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Riccardo',
                    'surname' => 'Costa',
                    'phone_number' => '+39 333 6789012',
                    'email' => 'riccardo.costa@example.com',
                    'message' => 'Posso richiedere una copia della mia cartella clinica?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Francesco',
                    'surname' => 'Russo',
                    'phone_number' => '+39 345 1238901',
                    'email' => 'francesco.russo@example.com',
                    'message' => 'Accetti pagamenti tramite carta di credito?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Marta',
                    'surname' => 'Ferri',
                    'phone_number' => '+39 366 5678901',
                    'email' => 'marta.ferri@example.com',
                    'message' => 'Quando posso fissare un appuntamento?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Roberta',
                    'surname' => 'Colombo',
                    'phone_number' => '+39 347 1234567',
                    'email' => 'roberta.colombo@example.com',
                    'message' => 'Hai disponibilità per una visita urgente?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Daniele',
                    'surname' => 'Mancini',
                    'phone_number' => '+39 333 5678901',
                    'email' => 'daniele.mancini@example.com',
                    'message' => 'Fornisci servizi di teleconsulto?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Paolo',
                    'surname' => 'Galli',
                    'phone_number' => '+39 366 7890123',
                    'email' => 'paolo.galli@example.com',
                    'message' => 'Quali sono i tuoi orari di disponibilità?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Silvia',
                    'surname' => 'Conti',
                    'phone_number' => '+39 347 2345678',
                    'email' => 'silvia.conti@example.com',
                    'message' => 'Cosa posso fare in caso di emergenza?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Giuseppe',
                    'surname' => 'Ricci',
                    'phone_number' => '+39 366 8901234',
                    'email' => 'giuseppe.ricci@example.com',
                    'message' => 'Accetti pazienti senza prenotazione?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Anna',
                    'surname' => 'Ferrari',
                    'phone_number' => '+39 333 6789012',
                    'email' => 'anna.ferrari@example.com',
                    'message' => 'Qual è il costo di una visita?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Luigi',
                    'surname' => 'Lombardi',
                    'phone_number' => '+39 345 1238901',
                    'email' => 'luigi.lombardi@example.com',
                    'message' => 'Hai esperienza con casi simili al mio?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Valentina',
                    'surname' => 'Rossetti',
                    'phone_number' => '+39 366 5678901',
                    'email' => 'valentina.rossetti@example.com',
                    'message' => 'Quali esami devo fare per una diagnosi più precisa?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Marco',
                    'surname' => 'Greco',
                    'phone_number' => '+39 347 1234567',
                    'email' => 'marco.greco@example.com',
                    'message' => 'Posso richiedere una seconda opinione?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Elena',
                    'surname' => 'Vitali',
                    'phone_number' => '+39 333 5678901',
                    'email' => 'elena.vitali@example.com',
                    'message' => 'Fornisci ricette mediche?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Fabio',
                    'surname' => 'Mancini',
                    'phone_number' => '+39 345 1234567',
                    'email' => 'fabio.mancini@example.com',
                    'message' => 'Come posso contattarti in caso di necessità?',
                    'doctor_id' => $doctors_ids->random(),
                ],
                [
                    'name' => 'Sara',
                    'surname' => 'Bianchi',
                    'phone_number' => '+39 366 7890123',
                    'email' => 'sara.bianchi@example.com',
                    'message' => 'Offri servizi di telemedicina?',
                    'doctor_id' => $doctors_ids->random(),
                ],
            ];

            foreach ($messagesData as $messageData) {
                $new_message = new Message();
                $new_message->name = $messageData['name'];
                $new_message->surname = $messageData['surname'];
                $new_message->phone_number = $messageData['phone_number'];
                $new_message->email = $messageData['email'];
                $new_message->message = $messageData['message'];
                $new_message->doctor_id = $messageData['doctor_id'];
                $new_message->created_at = $faker->dateTimeBetween('-3 years')->format('Y-m-d H:i:s');
                $new_message->updated_at = $new_message->created_at;
                $new_message->save();
            }
        }
    }
}