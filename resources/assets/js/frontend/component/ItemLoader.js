import React from 'react'

export default function ItemLoader() {
    return (
        <div className="progress">
            <div className="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style={{width: '100%',animationDuration: '0.5s'}}>
            </div>
        </div>
    )
}
