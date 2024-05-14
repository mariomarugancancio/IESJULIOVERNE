package com.ies.bargas.adapters;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentStatePagerAdapter;

import com.ies.bargas.fragments.GuardiasSalaProfesoresFragment;
import com.ies.bargas.fragments.GuardiasSemanaFragment;
import com.ies.bargas.fragments.GuardiasTotalFragment;
import com.ies.bargas.fragments.GuardiasUsuarioFragment;

public class PagerAdapterShifts extends FragmentStatePagerAdapter{

        private int numberOfTabs;
        public PagerAdapterShifts(FragmentManager fm, int numberOfTabs) {
            super(fm);
            this.numberOfTabs = numberOfTabs;
        }

        @NonNull
        @Override
        public Fragment getItem(int position) {
            switch (position) {
                case 0:
                    return new GuardiasSalaProfesoresFragment();
                case 1:
                    return new GuardiasSemanaFragment();
                case 2:
                    return new GuardiasTotalFragment();
                case 3:
                    return new GuardiasUsuarioFragment();
                default:
                    return null;
            }
        }

        @Override
        public int getCount() {
            return numberOfTabs;
        }
}

