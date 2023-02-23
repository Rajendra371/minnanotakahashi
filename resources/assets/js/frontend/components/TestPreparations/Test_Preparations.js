import React,{useState, useEffect} from 'react'
import SectionTitle from "../../component/SectionTitle";

const test = [
  {icon:"public", title:"JLPT Test" , img:"https://img1.wsimg.com/isteam/stock/lrre3B6/:/cr=t:0%25,l:0%25,w:100%25,h:100%25/rs=w:600,h:300,cg:true"},
  {icon:"live_help", title:"NAT Test" , img :"https://img1.wsimg.com/isteam/stock/0nZAmB/:/cr=t:0%25,l:0%25,w:100%25,h:100%25/rs=w:600,h:300,cg:true"},
  {icon:"subject", title:"TOP-J" , img:"https://img1.wsimg.com/isteam/stock/106499/:/cr=t:0%25,l:0%25,w:100%25,h:100%25/rs=w:900,h:450,cg:true"},
  {icon:"school", title:"JLCT Test", img:"https://isteam.wsimg.com/ip/48ded225-edcb-417e-91f6-c4903457bccb/AdobeStock_79305886.jpeg/:/cr=t:0%25,l:0%25,w:100%25,h:100%25/rs=w:600,h:300,cg:true"},
  {icon:"explore", title:"JFT Basic" ,img:"https://img1.wsimg.com/isteam/stock/11253/:/rs=w:900,h:450,cg:true,m/cr=w:900,h:450"},
]
export default function Test_Preparations() {
    const [tests, setTests] = useState(test)
    const [docId, setDocId] = useState(null)
    useEffect(()=>{
    setDocId(window.location.hash.slice(1))
    const elem = document.getElementById(docId);
        if (elem) {
        elem.scrollIntoView(true);
        window.scrollBy(0, -90);
        }
        window.scrollTo(0, 0);
    },[docId])
    return (
    <div className="relative py-8 md:py-14">
      {/* {loading ? (
        <LoaderSpinner />
      ) : ( */}
        <div className="container mx-auto">
          <div className="px-3 sm:px-6 lg:px-8 ">
            <div className="services">
               {tests.map((item,idx)=>
                   <div id={item.title.toLowerCase().split(" ").join("_")}   key={idx} className="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8 sm:mb-20 items-start">
                     <img className="object-cover h-100 lg:order-2 rounded-lg  lg:col-span-2 z-1" src={item.img} width="100%"/>
                        <div  className="lg:order-1  lg:col-span-1  lg:-mr-20 z-2 relative mx-3 sm:mx-5 lg:mr-0 -mt-24 sm:-mt-32 lg:mt-0">
                            <SectionTitle lower={item.title} align="center"/>
                            <div  className="p-3 sm:p-5 rounded-lg shadow-lg bg-secondary ">
                                <p  className="text-xs sm:text-sm font-light text-white  m-0 text-justify sm:leading-normal">
                                    The next important factor that partakes in one’s decision of going to foreign land for further studies is the Land itself! Children get confused in choosing a country owing to their (especially families) concerns over their safety, likeness, adjustment and wellbeing. We at Global Opportunities ease out their tensions regarding this by counselling on Course intended, Scholarships Opportunity, Visa availability, and many such aspects. Through in-person counselling and virtual information communication, we help the students in zeroing it down to their favourite destination of convenience. 
                                </p>
                            </div>
                        </div>
                   </div>
               )}
            </div>
          </div>
        </div>
       {/* )}   */}
    </div>
    )
}
