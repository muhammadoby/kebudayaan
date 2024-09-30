import {faker} from '@faker-js/faker';
import {type Comment} from '@/type/comment';
import generateUser from './UserGenerator';


const cultureTextComment = [
    `Indonesia kaya banget sama budaya! 😍 Dari Sabang sampai Merauke, 
     tiap daerah punya tradisi, bahasa, dan adat istiadat yang keren banget.
     Bangga jadi orang Indonesia! 🇮🇩❤️ Ayo kita jaga dan lestarikan budaya kita biar nggak hilang
     ditelan zaman 🙌 #BanggaBudayaIndonesia #LestarikanBudaya`,
    `Indonesia mempunyai banyak Dari Sabang sampai Merauke, 
     tiap daerah punya tradisi, bahasa, dan adat istiadat yang keren banget.
     Saya bangga jadi orang Indonesia. Mari kita lestarikan budaya indonesia 🙌❤️`,
     `Kebudayaan Indonesia begitu kaya dan beragam! 🎉. 
      🌏✨ Mari kita lestarikan dan rayakan warisan budaya ini! 🙌❤️`,
     `Kebudayaan Indonesia adalah harta yang tak ternilai! 🌈 Setiap suku, bahasa, dan tradisi menambah warna kehidupan kita.`,
     `Kebudayaan Indonesia penuh dengan keindahan dari budaya yang memukau `
];
const eventTextComment = [
     `Acara kebudayaan itu seru banget! 🎉. Selain buat seru-seruan,
      kita juga bisa belajar banyak soal budaya lain, 
      nambah wawasan, dan makin menghargai keberagaman 🌍.`,
      `Dengan acara kebudayaan ini Selalu ada yang baru buat dipelajari, contohnya seperti tariannya.
      Kita juga jadi makin paham dan menghargai kebudayaan orang lain 🙌🌏. `,
      `Acara kebudayaan tuh bener-bener asik,Di sana, kita bisa nikmatin tarian tradisional,
       musik-musik tradisional. Rasanya tuh gabungan antara seru, kagum, dan belajar hal baru 🙌.`,
      `Acara kebudayaan tuh selalu bikin suasana hidup! 🎉 Dari musik tradisional yang bikin merinding,
       sampai tarian yang bikin kagum, semuanya seru banget!. Nggak cuma asik ditonton,
       tapi juga bikin kita ngerasa terhubung sama nilai-nilai yang udah ada sejak dulu 📜✨.`,
     `Acara kebudayaan itu kayak momen spesial yang selalu bikin excited! 🎉💫 Di sana, kita bisa lihat
      berbagai pertunjukan seru, dari tari-tarian khas yang energik sampai musik tradisional yang bikin suasana makin hidup`

];
const generateComment : () => Omit<Comment,'comment'> = () => {
     return {
        user : generateUser(),
        reply: [],
        created_date: faker.date.between({ from: '2024-01-01', to: Date.now() })
     }
}

export const generateCultureComment : () => Comment = () => {
     return {
          ...generateComment(),
             comment: cultureTextComment[faker.number.int({min:0,max:cultureTextComment.length - 1})],
     }
}

export const generateEventComment : () => Comment = () => {
     return {
          ...generateComment(),
             comment: eventTextComment[faker.number.int({min:0,max:eventTextComment.length - 1})],
     }
}