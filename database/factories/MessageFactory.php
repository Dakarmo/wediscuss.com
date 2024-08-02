<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = \App\Models\User::pluck('id')->toArray();

        $isGroupMessage = fake()->boolean(50);

        $senderId = fake()->randomElement($userIds);

        $receiverId = null;
        $groupId = null;


        if($isGroupMessage) {
            $groupIds=\App\Models\Group::pluck('id')->toArray();

            if(empty($groupIds)){
                throw new \Exception("Aucun groupe trouvé dans la base de donnée");
            }

            $groupId = fake()->randomElement($groupIds);

            $group = \App\Models\Group::find($groupId);

            $senderId = fake()->randomElement($group->users->pluck('id')->toArray());
        }else {
            // c'est un message direct qu'on envoie
            // sélectionner un receiver qui est différent du sender
            $receiverId = fake()->randomElement(array_diff($userIds, [$senderId])); //array_diff([1, 2, 3, 4, 5], [3]) => [1, 2, 4, 5];
        }

        $conversationId = null;

        // if(!$isGroupMessage) {
        //     $conversationId = \App\Models\Conversation::firstOrCreate(
        //         [
        //             'user_id1' =>min($senderId, $receiverId),
        //             'user_id2' =>max($senderId, $receiverId),
        //         ],
        //         [
        //             'last_message_id' => null
        //         ]
        //      );
        // }


        return [
                //
                'message' => fake()->realText(),
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'group_id' => $groupId,
                'conversation_id' => $conversationId,
        ];
    }
}

