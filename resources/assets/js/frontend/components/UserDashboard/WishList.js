import React, { useContext, useEffect } from "react";
import SectionTitle from "../../component/SectionTitle";
import { GlobalContext } from "../../context/GlobalContext";
import MaterialTable from "material-table";
import { tableIcons } from "../../component/MaterialTableIcons";
import LoaderSpinner from "../../component/LoaderSpinner";
import AddtoCartButton from "../../component/AddtoCartButton";


export default function WishList() {
  const [isloading, setLoading] = React.useState(true);
  const { wishList, deleteFromwishList, currency } = useContext(GlobalContext);
  useEffect(() => { 
    setTimeout(() => setLoading(false), 300);
  },[])
  return (
    isloading ? <LoaderSpinner/> :
    <React.Fragment>
      <SectionTitle title="My WishList" />
      <div className="sidenav_main_content wishlist">
        <MaterialTable
          icons={tableIcons}
          columns={[
            {
              title: "Image",
              field: "image",
              render: (rowData) => (
                <a href={`/product/${rowData.product_slug}-${rowData.id}`}>
                  <img src={rowData.image} height="60" />
                </a>
              ),
            },
            { title: "Product Code", field: "product_code" },
            { title: "Product Name", field: "product_title" },
            {
              title: "Price",
              field: "price",
              render: (rowData) => `${currency} ${rowData.price}`,
            },
            {
              title: "Action",
              render: (rowData) => (
                <React.Fragment>
                {/* <AddtoCartButton product={rowData}/> */}
                <a
                  onClick={() => deleteFromwishList(rowData.id)}
                  className="remove"
                >
                  <i className="fa fa-trash-o" />
                </a>
                </React.Fragment>
              ),
            },
          ]}
          data={wishList}
          title=""
        />
      </div>
    </React.Fragment>
  );
}
