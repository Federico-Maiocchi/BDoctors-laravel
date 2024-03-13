<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Review;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $doctors = Doctor::all();
        $doctors_ids = $doctors->pluck('id');

        $votes = Vote::all();
        $votes_ids = $votes->pluck('id');

        for ($i = 0; $i < 100; $i++) {
            $reviewsData = [
                [
                    'name' => 'Mario',
                    'message' => 'Il dottore è stato molto professionale, consiglio a tutti!',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 4,
                ],
                [
                    'name' => 'Laura',
                    'message' => 'Esperienza deludente, il dottore sembrava poco interessato.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 3,
                ],
                [
                    'name' => 'Giovanni',
                    'message' => 'Il dottore è stato molto gentile e disponibile.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 4,
                ],
                [
                    'name' => 'Alessia',
                    'message' => 'Molto delusa dalla visita, il dottore sembrava distratto.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 2,
                ],
                [
                    'name' => 'Riccardo',
                    'message' => 'Esperienza positiva, il dottore ha risposto a tutte le mie domande.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Sofia',
                    'message' => 'Il dottore è stato professionale e cortese, lo consiglio.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 4,
                ],
                [
                    'name' => 'Antonio',
                    'message' => 'Esperienza neutra, nulla di eccezionale.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 3,
                ],
                [
                    'name' => 'Giorgia',
                    'message' => 'Il dottore ha spiegato chiaramente il mio problema, molto soddisfatta.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Luca',
                    'message' => 'Non ho ricevuto le risposte che cercavo, esperienza deludente.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 2,
                ],
                [
                    'name' => 'Martina',
                    'message' => 'Il dottore è stato disponibile a risolvere ogni mio dubbio.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 4,
                ],
                [
                    'name' => 'Andrea',
                    'message' => 'Esperienza positiva, il dottore ha mostrato grande professionalità.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Valentina',
                    'message' => 'Non consiglio questo medico, scarsa attenzione alle mie problematiche.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 2,
                ],
                [
                    'name' => 'Simone',
                    'message' => 'Il dottore ha risolto il mio problema in modo efficiente, consigliato.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Elisa',
                    'message' => 'Il dottore ha mostrato grande competenza, sono molto soddisfatta.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Davide',
                    'message' => 'Esperienza negativa, il dottore sembrava di fretta.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 2,
                ],
                [
                    'name' => 'Roberta',
                    'message' => 'Consiglio questo medico, ha risolto il mio problema con cura.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 4,
                ],
                [
                    'name' => 'Giacomo',
                    'message' => 'Il dottore è stato gentile, ma la visita è stata breve.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 3,
                ],
                [
                    'name' => 'Francesco',
                    'message' => 'Esperienza positiva, il dottore ha risposto a tutte le mie domande.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Elena',
                    'message' => 'Il dottore ha spiegato chiaramente la mia situazione, consigliato.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 4,
                ],
                [
                    'name' => 'Alessandro',
                    'message' => 'Non sono soddisfatto della visita, il dottore sembrava distante.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 2,
                ],
                [
                    'name' => 'Giulia',
                    'message' => 'Il dottore ha risolto il mio problema con professionalità, lo consiglio.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Fabio',
                    'message' => 'Esperienza neutra, nulla di particolare da segnalare.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 3,
                ],
                [
                    'name' => 'Marta',
                    'message' => 'Il dottore è stato molto gentile, ma la soluzione proposta non mi ha convinto.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 3,
                ],
                [
                    'name' => 'Luca',
                    'message' => 'Il dottore è stato molto professionale e attento alle mie esigenze. Mi ha spiegato chiaramente il piano di cura e mi sono sentito molto rassicurato.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Alessandro',
                    'message' => 'Sono rimasta molto delusa dalla visita. Il dottore sembrava poco interessato e non mi ha dato alcuna soluzione ai miei problemi.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 1,
                ],
                [
                    'name' => 'Nicolas',
                    'message' => 'Consiglio vivamente questo dottore! Competente, gentile e disponibile. Mi ha aiutato tantissimo.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
                [
                    'name' => 'Paola',
                    'message' => 'Non ho avuto una buona esperienza con questo dottore. Mi ha dato una diagnosi sbagliata e mi sono trovato peggio dopo la visita.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 2,
                ],
                [
                    'name' => 'Alfredo',
                    'message' => 'Il dottore è stato molto disponibile e competente. Ha risolto il mio problema in poco tempo e con molta gentilezza.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 4,
                ],
                [
                    'name' => 'Giovanna',
                    'message' => 'Non posso che lodare questo dottore. Ha un approccio umano e empatico e si prende cura veramente dei suoi pazienti.',
                    'doctor_id' => $doctors_ids->random(),
                    'vote_id' => 5,
                ],
            ];

            foreach ($reviewsData as $reviewData) {
                $new_review = new Review();
                $new_review->name = $reviewData['name'];
                $new_review->message = $reviewData['message'];
                $new_review->doctor_id = $reviewData['doctor_id'];
                $new_review->vote_id = $reviewData['vote_id'];
                $new_review->created_at = $faker->dateTimeBetween('-3 years')->format('Y-m-d H:i:s');
                $new_review->updated_at = $new_review->created_at;
                $new_review->save();
            }
            ;
        }
        ;

    }
}
