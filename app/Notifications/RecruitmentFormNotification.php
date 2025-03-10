<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RecruitmentFormNotification extends Notification
{
    use Queueable;

    private $recruitmentForm;
    private $subject;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($recruitmentForm, $subject)
    {
        $this->recruitmentForm = $recruitmentForm;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line('<strong>Submetido por: </strong>' . $this->recruitmentForm->user->name)
            ->line('<strong>Nome do candidato: </strong>' . $this->recruitmentForm->name)
            ->line('<strong>Email do candidato: </strong>' . $this->recruitmentForm->email)
            ->line('<strong>Telefone: </strong>' . $this->recruitmentForm->phone)
            ->line('<strong>Contacto efetuado com sucesso: </strong>' . $this->recruitmentForm->contact_successfully == 1 ? 'Sim' : 'Não')
            ->line('<strong>Contacto: </strong>' . $this->recruitmentForm->phone)
            ->line('<strong>Agendou entrevista: </strong>' . $this->recruitmentForm->scheduled_interview == 1  ? 'Sim' : 'Não')
            ->line('<strong>Data da entrevista: </strong>' . $this->recruitmentForm->appointment)
            ->line('<strong>Realizada?: </strong>' . $this->recruitmentForm->done == 1 ? 'Sim' : 'Não')
            ->line('<strong>Observações: </strong>' . $this->recruitmentForm->comments)
            ->line('<strong>Estado da lead: </strong>' . $this->recruitmentForm->status)
            ->line('<strong>Tipo da lead: </strong>' . $this->recruitmentForm->type)
            ->line('<strong>Canal: </strong>' . $this->recruitmentForm->chanel)
            ->line('<strong>Horário: </strong>' . $this->recruitmentForm->daytime)
            ->action('Curriculum vitae', url($this->recruitmentForm->cv && $this->recruitmentForm->cv->original_url ? $this->recruitmentForm->cv->original_url : ''))
            ->line('Obrigado por utilizar os serviçoes da Expertcom!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
