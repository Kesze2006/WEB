
import { MDBCalendar } from 'mdb-react-calendar';

export default function App() {
  const today = new Date();

  const getStringDate = (date: Date) => date.toLocaleDateString('en-GB').replaceAll('.', '/');

  const addDays = (date: Date, days: number) => {
    return new Date(date.getFullYear(), date.getMonth(), date.getDate() + days);
  };

  const myEvents = [
    {
      summary: 'JS Conference',
      description: '',
      start: {
        date: getStringDate(today),
      },
      end: {
        date: getStringDate(today),
      },
      color: {
        background: 'rgb(207, 224, 252)',
        foreground: 'rgb(10, 71, 169)',
      },
    },
    {
      summary: 'Vue Meetup',
      description: '',
      start: {
        date: getStringDate(addDays(today, 1)),
      },
      end: {
        date: getStringDate(addDays(today, 5)),
      },
      color: {
        background: 'rgb(235, 205, 254)',
        foreground: 'rgb(110, 2, 177)',
      },
    },
    {
      summary: 'Angular Meetup',
      description:
        'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur',
      start: {
        date: getStringDate(addDays(today, -3)),
        time: '10:00',
      },
      end: {
        date: getStringDate(addDays(today, 3)),
        time: '14:00',
      },
      color: {
        background: 'rgb(199, 245, 217)',
        foreground: 'rgb(11, 65, 33)',
      },
    },
    {
      summary: 'React Meetup',
      description: '',
      start: {
        date: getStringDate(addDays(today, 5)),
      },
      end: {
        date: getStringDate(addDays(today, 8)),
      },
      color: {
        background: 'rgb(253, 216, 222)',
        foreground: 'rgb(121, 6, 25)',
      },
    },
    {
      summary: 'Meeting',
      description: '',
      start: {
        date: getStringDate(addDays(today, 1)),
        time: '8:00',
      },
      end: {
        date: getStringDate(addDays(today, 1)),
        time: '12:00',
      },
      color: {
        background: 'rgb(207, 224, 252)',
        foreground: 'black',
      },
    },
    {
      summary: 'Call',
      description: '',
      start: {
        date: getStringDate(addDays(today, 2)),
        time: '11:00',
      },
      end: {
        date: getStringDate(addDays(today, 2)),
        time: '14:00',
      },
      color: {
        background: 'black',
        foreground: 'black',
      },
    },
  ];

  return (
    <MDBCalendar defaultEvents={myEvents} />
  );
}