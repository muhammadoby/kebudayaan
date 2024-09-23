import {faker} from '@faker-js/faker';
let id = 0;
const viewOption = {min: 10,max: 100};
export default [
    {
        id : id++,
        name: 'Tari kecak',
        location: 'bali',
        writter: 'I Putu Sastrawan',
        description: `Tari Kecak adalah pertunjukan drama tari khas Bali yang umumnya mengangkat kisahRamayana. Tarian ini ditarikan oleh puluhan penari laki-laki yang duduk secara
                  melingkar.Mereka menyerukan "cak cak cak" sambil mengangkat kedua lengan. Pada satu
                  segmen, mereka menirukan adegan saat barisan kera membantu Rama dalam pertempuran melawan Rahwana yang
                  menculik Dewi Sita.`,
        image: new URL('@/assets/image/home/grid-img1.jpg', import.meta.url).href,
        view: faker.number.int(viewOption),
        date: faker.date.between({ from: '2000-01-01', to: Date.now() }),
    },
    {
        id : id++,
        name: 'Reog ponorogo',
        location: 'Jawa Timur',
        writter: 'Akmal Fuad',
        description: `Reog Ponorogo merupakan salah satu tradisi masyarakat Ponorogo yang yang masihhidup dan bertujuan mempererat tali silaturahmi masyarakat Ponorogo. Kesenian
                      yang mulanya bernama “Barongan”.`,
        image: 'https://img.antaranews.com/cache/1200x800/2024/07/09/1000313007.jpg',
        view: faker.number.int(viewOption),
        date: faker.date.between({ from: '2000-01-01', to: Date.now() })
    },
    {
        id : id++,
        name: 'Pengerupukan',
        location: 'Bali',
        writter: 'Made Anggara',
        description: `Pengerupukan adalah salah satu tahapan pelaksanaan Hari Suci Nyepi yang memiliki
                      makna mengusir Bhuta Kala dari lingkungan rumah, pekarangan, dan lingkungan
                      sekitar. Bhuta Kala adalah wujud manifestasi sifat buruk bagi umat hindu dan
                      lingkungan sekitar.`,
        image: 'https://piaagungbali.com/wp-content/uploads/2024/03/tradisi-pengerupukan.jpg',
        view: faker.number.int(viewOption),
        date: faker.date.between({ from: '2000-01-01', to: Date.now() })
    },
    {
        id : id++,
        name: 'Lompat Batu Nias',
        location: 'Sumatera Barat',
        writter: 'Fachri Bahri',
        description: `Sebuah tradisi yang hanya dilakukan oleh laki-laki suku Nias. Tradisi Lompat
                      Batu biasanya dilakukan para pemuda dengan cara melompati tumpukan batu setinggi
                      2 meter untuk menunjukkan bahwa mereka sudah pantas untuk dianggap dewasa secara
                      fisik.`,
        image: 'https://awsimages.detik.net.id/community/media/visual/2022/09/20/tradisi-lompat-batu_169.jpeg?w=1200',
        view: faker.number.int(viewOption),
        date: faker.date.between({ from: '2000-01-01', to: Date.now() })

    },
    {
        id : id++,
        name: 'Mageret Pandah',
        location: 'Bali',
        writter: 'Putu Juniawan',
        description: `Perang pandan adalah salah satu tradisi yang ada di Desa Tenganan, Kecamatan
                     Karangasem, Bali. Perang pandan juga disebut dengan istilah makere-kere. Upacara
                     perang pandan menjadi daya tarik bagi wisatawan, baik wisatawan dalam negeri
                     maupun wisatawan asing.`,
        image: 'https://plazarenon.com/lumonata-plugins/additional/background/mageret-pandan-1562125653.jpeg',
        view: faker.number.int(viewOption),
        date: faker.date.between({ from: '2000-01-01', to: Date.now() })

    },
    {
        id : id++,
        name: 'Tari Saman',
        location: 'Aceh',
        writter: 'Ahmad dani',
        description: `Tari Saman merupakan salah satu kesenian berasal dari kabupaten Gayo, Aceh yang
                      memperkuat budaya Indonesia sehingga berada di pangkuan dunia. Sejarah mengenai
                      Tari Saman belum ada pendapat secara pasti awal terciptanya nama tari yang
                      berasal dari Gayo ini.`,
        image: 'https://www.blibli.com/friends-backend/wp-content/uploads/2022/07/60dacbf4238f5.jpg',
        view: faker.number.int(viewOption),
        date: faker.date.between({ from: '2000-01-01', to: Date.now() })

    }
];