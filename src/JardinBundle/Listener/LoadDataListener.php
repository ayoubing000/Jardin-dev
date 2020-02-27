<?php
namespace JardinBundle\Listener;
use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\Event;
use Doctrine\ORM\EntityManagerInterface;
use JardinBundle\Entity\CalendarEvent as MyCustomEvent;


class LoadDataListener
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     * @throws \Exception
     */
    public function loadData(CalendarEvent $calendarEvent)
    {
        //You may want do a custom query to populate the events
        $repository = $this->em->getRepository('JardinBundle:transport');
        $schedules = $repository->findAll();
        //var_dump($schedules);
        //die();
        //format("Y-m-d\TH:i:sP")
        // You may want to add an Event into the Calendar view.
        /** @var
         * Schedule $schedule
         */
        foreach ($schedules as $schedule) {
            $eventEntity = new Event($schedule->getTitre(), $schedule->getDateDebut(), $schedule->getDateFin());

            //optional calendar event settings
            $eventEntity->setId($schedule->getId());
            $eventEntity->setStartDate($schedule->getDateDebut());
            $eventEntity->setEndDate($schedule->getDateFin());
            $eventEntity->setAllDay(false); // default is false, set to true if this is an all day event
            $eventEntity->setEditable(false);
            $eventEntity->setStartEditable(false);
            $eventEntity->setColor('#F5876'); //set the background color of the event's label
            $eventEntity->setTextColor('#FFFFFF'); //set the foreground color of the event's label
            $eventEntity->setUrl('http://localhost/Jardin/web/app_dev.php/transport/1/show'); // url to send user to when event label is clicked
            $eventEntity->setClassName('JardinBundle:transport'); // a custom class you may want to apply to event labels

            //dump($eventEntity);die();

            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($eventEntity);
        }

        // defaults contents
       // $startDate = $calendarEvent->getStart();
       // $endDate = $calendarEvent->getEnd();
       // $filters = $calendarEvent->getFilters();

        //You may want do a custom query to populate the events

       // $calendarEvent->addEvent(new MyCustomEvent('Event Title 1', new \DateTime()));
        //$calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()));
    }




}