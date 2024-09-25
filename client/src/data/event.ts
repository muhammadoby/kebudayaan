import { generateEventComment } from '@/util/commentGenerator';
import {faker} from '@faker-js/faker';
const randomStatus = () => {
    const status = ['Akan datang','Telah berakhir','Sedang berlangsung'];
    return status[faker.number.int({min: 0,max:status.length - 1})];
}
const randomNumber = (min: number,max: number) => {
    return faker.number.int({min,max});
}
const randomStartDate = () =>  {
    return faker.date.between({ from: '2024-01-01', to: '2024-3-01' });
};
const randomEndDate = () =>  {
    return faker.date.between({ from: '2024-03-02', to: '2024-04-01' });
};
const randomBuyMethod = (price?: number) => {
    if(price === 0){
        return;
    }
    const buyMethod = ['Hubungi 082137700298','Datang ke tempat langsung'];

    return buyMethod[faker.number.int({
        min: 0,
        max: buyMethod.length - 1
    })];
}
const data =  [
    {
        name: 'Pesta Kesenian Bali',
        location: 'Jl. Nusa Indah No.1, Panjer, Denpasar Selatan, Kota Denpasar, Bali 80236',
        description: `Pesta Kesenian Bali adalah parade atau festival kesenian tahunan yang
                      diprakarsai oleh Pemerintah Provinsi Bali, serta dijadikan sebagai wadah
                      aktivitas dan kreativitas para seniman dalam upaya mendukung program pemerintah
                      dalam hal penggalian, pelestarian, dan pengembangan nilai-nilai seni budaya
                      Bali.`,
        organizer: 'Pemerintah provinsi bali',
        price: 0,
        image: 'https://awsimages.detik.net.id/community/media/visual/2022/07/03/ilustrasi-jadwal-pesta-kesenian-bali-pkb-selasa-5-juli-2022_169.jpeg?w=600&q=90',
    },
    {
        name: 'Sekaten Yogyakarta',
        location: 'Alun-Alun Utara, Kraton Yogyakarta, Yogyakarta.',
        description: `Sekaten adalah festival tradisional yang digelar setiap tahun untuk memperingati
                      Maulid Nabi Muhammad SAW. Acara ini menampilkan musik gamelan dan berbagai
                      pameran seni budaya.`,
        organizer: 'Pemerintah Yogyakarta',
        price: 10000,
        image: 'https://pariwisata.jogjakota.go.id/resources/img/article/20190219131655.jpg',
    },
    {
        name: 'Festival Tabuik',
        location: 'Pantai Gandoriah, Pariaman, Sumatera Barat.',
        description: ` Tabuik adalah festival budaya di Pariaman untuk memperingati peristiwa Asyura,
                       yang menampilkan prosesi pengusungan Tabuik ke pantai dan dilepaskan ke laut.`,
        organizer: 'Pemerintah Sumatera Barat',
        price: 15000,
        image: 'https://indonesiakaya.com/wp-content/uploads/2020/10/Festival_Tabuik_1200.jpg'
    },
    {
        name: 'Festival Keraton Nusantara',
        location: 'Keraton Surakarta, Solo, Jawa Tengah.',
        description: `Festival ini merupakan ajang berkumpulnya keraton-keraton dari seluruh Indonesia
                      untuk menampilkan budaya dan tradisi masing-masing, termasuk upacara adat,
                      tari-tarian, dan pameran.`,
        organizer: 'Pemerintah Jawa Tengah',
        price: 20000,
        image: 'https://asset.kompas.com/crops/UW8B5IkZndFqSgLtosi7Lf3GKo4=/102x0:702x400/750x500/data/photo/2017/09/16/647235463.jpg'
    },
    {
        name: 'Festival Danau Toba',
        location: 'Kawasan Danau Toba, Sumatera Utara.',
        description: `Acara tahunan ini diadakan untuk merayakan budaya Batak dan menampilkan lomba
                      kapal tradisional, tari-tarian Batak, dan pameran budaya.`,
        organizer: 'Pemerintah Sumatera utara',
        price: 20000,
        image: 'https://cdn.idntimes.com/content-images/post/20190828/pasted-image-0-bc14a54e137d441877938bde27c36edc_600x400.png',
    },
    {
        name: 'Festival Lembah Baliem',
        location: 'Lembah Baliem, Kabupaten Jayawijaya, Papua.',
        description: `Fesival Budaya Lembah Baliem ini adalah sebuah acara untuk melestarikan budaya
                      masyarakat Lembah Baliem yang umumnya digelar di wilayah kabupaten Jayawijaya
                      pada bulan Agustus dengan cara memperkenalkan budaya yang ada di Papua.`,
        organizer: 'Pemerintah Papua',
        price: 20000,
        image: 'https://www.pesonaindo.com/wp-content/uploads/2016/04/Festival-Lembah-Baliem-Wamena-Papua-2-1.jpg',
    },
];
export default data.map((data,index) => {
    return{
        id: index,
        view: faker.number.int({min: 10,max: 100}),
        buyMethod: randomBuyMethod(data.price),
        status: randomStatus(),
        startDate: randomStartDate(),
        endDate: randomEndDate(),
        comment: Array.from({length: randomNumber(10,10) },(_,id) => {
            return {
                id,
                ...generateEventComment()
            }
        }),
        ...data,
    }
});