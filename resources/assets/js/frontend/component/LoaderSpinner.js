import React from 'react'
import Loader from 'react-loader-spinner'
import "react-loader-spinner/dist/loader/css/react-spinner-loader.css"

export default function LoaderSpinner() {
    return (
        <div className="flex justify-center items-center w-100" style={{height:"30vh"}}>
            <Loader
                type="Puff"
                color="#97e45d"
                height={60}
                width={60}
            />
        </div>
    )
}
