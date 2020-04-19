package com.agaveazul.interactor;

import com.agaveazul.boundry.interactor.FindUnitsInteractor;
import com.agaveazul.boundry.callback.FindUnitsCallback;
import com.agaveazul.boundry.port.input.FindUnitsInputPort;
import com.agaveazul.boundry.port.output.FindUnitsOutputPort;
import com.agaveazul.gateway.UnitGateway;
import com.agaveazul.gateway.dto.FindUnitCriteria;
import lombok.Setter;

public class FindUnitsInteractorImpl implements FindUnitsInteractor {
    @Setter
    private UnitGateway unitGateway;

    @Override
    public void execute(FindUnitsInputPort inputPort, FindUnitsCallback callback) {
        FindUnitsOutputPort outputPort = new FindUnitsOutputPort();
        FindUnitCriteria criteria = new FindUnitCriteria();
        criteria.setDescription(inputPort.description);
        criteria.setStatus(inputPort.unitStatus);
        outputPort.units = unitGateway.find(criteria);
        callback.execute(outputPort);
    }


}
