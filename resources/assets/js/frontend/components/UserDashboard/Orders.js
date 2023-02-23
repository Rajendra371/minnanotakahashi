import React, { useContext, useEffect } from "react";
import SectionTitle from "../../component/SectionTitle";
import MaterialTable from "material-table";
import { tableIcons } from "../../component/MaterialTableIcons";
import { AuthContext } from "../../context/AuthContext";
import LoaderSpinner from "../../component/LoaderSpinner";
import { GlobalContext } from "../../context/GlobalContext";

export default function Orders() {
  const [isloading, setLoading] = React.useState(true);

  const { user_order_list } = useContext(AuthContext);
  // const { currency } = useContext(GlobalContext);

  useEffect(() => {
    setTimeout(() => setLoading(false), 300);
  }, []);
  return isloading ? (
    <LoaderSpinner />
  ) : (
    <React.Fragment>
      <SectionTitle title="My Orders" />
      <div className="sidenav_main_content orders">
        <MaterialTable
          icons={tableIcons}
          columns={[
            { title: "Order No", field: "orderno" },
            { title: "Order Date", field: "checkout_datead" },
            { title: "Tot Products", field: "total_product" },
            {
              title: "Grand Total",
              field: "grand_totalamt",
              render: (rowData) => `${rowData.currency} ${rowData.grand_totalamt}`,
            },
            {
              title: "Order Status",
              field: "status",
              
              lookup: { O: "Ordered", C: "Cancelled", CO: "Confirmed" },
              render: rowData => {
                return (
                  rowData.status == "O" ? <p style={{ backgroundColor: "#f5d730"}}>Ordered</p> :
                    rowData.status == "CO" ? <p style={{ backgroundColor: "#43dd43"}}>Confirmed</p> :
                      <p style={{ backgroundColor: "rgb(255, 67, 67)"}}>Cancelled</p>
                )}
              
            },
          ]}
          data={user_order_list}
          detailPanel={(rowData) => {
            const tableStyle = rowData.status == "O" ? { backgroundColor: "#f5d730",color:"#0b0b0b" } : 
            rowData.status == "CO" ? { backgroundColor: "#43dd43",color:"#0b0b0b" } :
                { backgroundColor: "rgb(255, 67, 67)", color:"#0b0b0b" } 
            return (
              <table className="table table-hover table-borderless table-striped  mb-0 inner_table table-sm" style={tableStyle}>
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th style={{textAlign:"right"}}>Total Amount</th>
                  </tr>
                </thead>
                <tbody>
                  {rowData.order_details.map((od, i) => {
                    if (rowData.id === od.master_id) {
                      return (
                        <tr key={i}>
                          <td>
                            <img
                              src={od.image}
                              alt="MeroRug Carpet"
                              height="40"
                            />
                          </td>
                          <td>{od.product_code}</td>
                          <td>{od.product_title}</td>
                          <td>{od.qty}</td>
                          <td>{`${rowData.currency} ${od.rate}`}</td>
                          <td align="right">{`${rowData.currency} ${od.total_amt}`}</td>
                        </tr>
                      );
                    }
                  })}
                </tbody>
              </table>
            );
          }}
          onRowClick={(event, rowData, togglePanel) => togglePanel()}
          title=""
        />
      </div>
    </React.Fragment>
  );
}
